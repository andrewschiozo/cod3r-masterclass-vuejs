<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

try{
    match ($_SERVER['REQUEST_URI']) {
        '/api/login' => login()
        , '/api/auth/verify' => verifyToken()
        , '/api/order' => getOrder()
        , '/api/ordersave' => saveOrder()
        , '/api/orderdelete' => deleteOrder()
        , default => response(message: 'Route not found', code: 404)
    };
}
catch(Exception $e) {
    response(message: $e->getMessage(), code: 400);
}

function login() {
    if(!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'OPTIONS']))
        return response(message: 'Method not allowed', code: 405);

    $inputData = json_decode(file_get_contents('php://input'));
    
    if(!property_exists($inputData, 'username') || !property_exists($inputData, 'password')) 
        return response(message: 'Expected username and password', code: 400);
    
    $filter = "email = '" . $inputData->username . "'";
    $users = getDbData('users', $filter);
    
    if(!count($users))
        return response(message: 'User not found', code: 401);

    $user = $users[0];
    if(!password_verify($inputData->password, $user->password))
        return response(message: 'Invalid password', code: 401);
    
    return response(data: ['token' => $user->token]);
    
}

function verifyToken() {
    return response(message: 'Authorized', code: 200);
}

function getOrder() {
    try{
        $orders = getDbData('orders');
        response(data: $orders);
        return;
    }
    catch(PDOException $e) {
        response(message: $e->getMessage(), code: 400);
        return;
    }
}

function saveOrder() {
    $inputData = json_decode(file_get_contents('php://input'));
    
    if(isset($inputData->order) && $inputData->order > 0)
    {
        $filter = '"order" = ' . $inputData->order;
        $orders = getDbData('orders', $filter);
        if(!count($orders))
            return response(message: 'Order not found', code: 404);

        unset($inputData->order);
        $inputData->id = $orders[0]->id;
        updateDbData('orders', $inputData);
        return response(['message' => 'Registro atualizado'], 200);
    }

    $inputData->order = random_int(100000, 999999);

    $id = insertDbData('orders', $inputData);
    return response(['message' => 'Registro inserido'], 200);
   
}

function deleteOrder() {
    
    $inputData = json_decode(file_get_contents('php://input'));
    
    if(isset($inputData->order) && $inputData->order > 0)
    {   
        $filter = '"order" = ' . $inputData->order;
        
        $orders = getDbData('orders', $filter);
        
        if(!count($orders))
            return response(message: 'Order not found', code: 404);

        deleteDbData('orders', $orders[0]->id);
        return response(['message' => 'Registro excluído'], 200);
    }
}

function response($data = null, $message = null, $code = 200) {    
    http_response_code($code);
    echo json_encode(['message' => $message, 'data' => $data]);
    return;
}

function getDbData($table, $where = null) {
    try {
        $pdo = new PDO('sqlite:app.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $whereString = $where ? ' WHERE ' . $where : '';

        $query = 'SELECT * FROM ' . $table . $whereString;
        error_log($query);
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
}

function insertDbData($table, stdClass $data) {
    try {
        $pdo = new PDO('sqlite:app.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $keys = array_keys(get_object_vars($data));
        $values = array_values(get_object_vars($data));
        $query = 'INSERT INTO ' . $table . ' ("' . implode('", "', $keys) . '") VALUES (' . implode(', ', array_fill(0, count($keys), '?')) . ')';
        $stmt = $pdo->prepare($query);
        $stmt->execute($values);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
}

function updateDbData($table, stdClass $data) {
    $id = $data->id;
    unset($data->id);
    try{
        $pdo = new PDO('sqlite:app.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $keys = array_keys(get_object_vars($data));
        $values = array_values(get_object_vars($data));
        $query = 'UPDATE ' . $table . ' SET "' . implode('" = ?, "', $keys) . '" = ? WHERE id = ' . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute($values);
        return $pdo->lastInsertId();
    }
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
}

function deleteDbData($table, $id) {
    try{
        $pdo = new PDO('sqlite:app.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $query = 'DELETE FROM ' . $table . ' WHERE id = ' . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $pdo->lastInsertId();
    }
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
}