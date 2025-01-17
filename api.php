<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

define('INPUT_DATA', json_decode(file_get_contents('php://input')) ?? json_decode('{}'));

switch ($_SERVER['REQUEST_URI']) {
    case '/api/login':
        routeLogin();
        break;
    case '/api/auth/verify':
        verifyToken();
        break;
    case '/api/orders/':
        routeOrders();
        break;
    default:
        routeDefault();
        error_log('Route not found');
        break;
}

function routeDefault() {
    response(['message' => 'Hello World!'], 200);
}

function routeLogin() {
    if($_SERVER['REQUEST_METHOD'] !== 'POST')
        return routeDefault();
    
    define('USERS', [
        'u1@mail.com' => password_hash('123456', PASSWORD_DEFAULT),
        'u2@mail.com' => password_hash('123456', PASSWORD_DEFAULT),
        'u3@mail.com' => password_hash('123456', PASSWORD_DEFAULT)
    ]);

    // $inputData = json_decode(file_get_contents('php://input'));
    if(!property_exists(INPUT_DATA, 'username') || !property_exists(INPUT_DATA, 'password'))
        return response(['message' => 'Expected username and password'], 404);

    if(!isset(USERS[INPUT_DATA->username]))
        return response(['message' => 'User not found'], 404);
    
    $userPassword = USERS[INPUT_DATA->username];
    
    if(!password_verify(INPUT_DATA->password, $userPassword))
        return response(['message' => 'Unauthorized'], 401);
    
    $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlVzdcOhcmlvIiwiaWF0IjoxNTE2MjM5MDIyfQ.nZk-9TMEvUeeIRu5vUogmaPC6wTePr_sMi9PlKowfDk';

    http_response_code(200);
    echo json_encode(['user' => 'João Vicente', 'token' => $token]);
    return;
}

function verifyToken() {
    // if()
    return response(['message' => 'Authorized'], 200);
}

function response($data, $code) {
    http_response_code($code);
    echo json_encode($data);
    error_log(json_encode($data));
    return;
}