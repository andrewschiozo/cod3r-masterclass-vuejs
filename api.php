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
        'u1@mail.com' => ['firstName' => 'João Vicente'
                         ,'lastName' => 'Costa Chiozo'
                         ,'birthday' => '2025-05-26'
                         ,'profile' => ['Admin']
                         ,'password' => password_hash('123456', PASSWORD_DEFAULT)
                         ,'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiaWF0IjoxNTE2MjM5MDIyLCJ1c2VyRGF0YSI6eyJmaXJzdE5hbWUiOiJKb8OjbyBWaWNlbnRlIiwibGFzdE5hbWUiOiJDb3N0YSBDaGlvem8iLCJiaXJ0aGRheSI6IjIwMjUtMDUtMjYiLCJwcm9maWxlIjpbIkFkbWluIl19fQ.CB0wwmpBGNArRZYRzBZzevA756mN70wME8aXrTWnRxQ']
        ,'u2@mail.com' => ['firstName' => 'Maria Helena'
                         ,'lastName' => 'Costa Chiozo'
                         ,'birthday' => '2026-07-02'
                         ,'profile' => ['Teacher']
                         ,'password' => password_hash('123456', PASSWORD_DEFAULT)
                         ,'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiaWF0IjoxNTE2MjM5MDIyLCJ1c2VyRGF0YSI6eyJmaXJzdE5hbWUiOiJNYXJpYSBIZWxlbmEiLCJsYXN0TmFtZSI6IkNvc3RhIENoaW96byIsImJpcnRoZGF5IjoiMjAyNi0wNy0wMiIsInByb2ZpbGUiOlsiVGVhY2hlciJdfX0.G10zyGi5fjLMY2s0v0yHNxzlNZ1F23qstaa_eHvWWHs']
        ,'u3@mail.com' => ['firstName' => 'Laura'
                         ,'lastName' => 'Costa Chiozo'
                         ,'birthday' => '2027-09-11'
                         ,'profile' => ['Student']
                         ,'password' => password_hash('123456', PASSWORD_DEFAULT)
                         ,'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiaWF0IjoxNTE2MjM5MDIyLCJ1c2VyRGF0YSI6eyJmaXJzdE5hbWUiOiJMYXVyYSIsImxhc3ROYW1lIjoiQ29zdGEgQ2hpb3pvIiwiYmlydGhkYXkiOiIyMDI3LTA5LTExIiwicHJvZmlsZSI6WyJTdHVkZW50Il19fQ.6OWWsuS4uHvH4cnObVfH6kOOadYiCdr8YdeUxbdmG68']
    ]);

    // $inputData = json_decode(file_get_contents('php://input'));
    if(!property_exists(INPUT_DATA, 'username') || !property_exists(INPUT_DATA, 'password'))
        return response(['message' => 'Expected username and password'], 404);

    if(!isset(USERS[INPUT_DATA->username]))
        return response(['message' => 'User not found'], 404);
    
    $userPassword = USERS[INPUT_DATA->username]['password'];

    if(!password_verify(INPUT_DATA->password, $userPassword))
        return response(['message' => 'Unauthorized'], 401);
    
    http_response_code(200);
    echo json_encode(['token' => USERS[INPUT_DATA->username]['token']]);
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