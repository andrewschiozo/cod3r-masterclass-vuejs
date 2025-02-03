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
    
    $users = getDbData('users', "email = '" . $inputData->username . "'");
    
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
    try{
        $conn = conn();
        $query = "INSERT INTO orders ('order', 'client', 'amount', 'items', 'status') VALUES (?,?,?,?,?)";    
        $stmt = $conn->prepare($query);
        $stmt->execute(array('20468', 'João Vicente', '1600', '21', 'pending'));
        response(['message' => 'Registro salvo'], 200);
    }
    catch(PDOException $e) {
        response(message: $e->getMessage(), code: 400);
    }
}

function response($data = null, $message = null, $code = 200) {    
    http_response_code($code);
    echo json_encode(['message' => $message, 'data' => $data]);
    return json_encode(['message' => $message, 'data' => $data]);
}

function getDbData($table, $where = null) {
    try {
        $pdo = new PDO('sqlite:app.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $whereString = $where ? ' WHERE ' . $where : '';

        $query = 'SELECT * FROM ' . $table . $whereString;
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
}