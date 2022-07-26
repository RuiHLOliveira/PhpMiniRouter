<?php

require './vendor/autoload.php';

use FluxoDeCaixa\Core\Router;

set_error_handler(function (int $errNo, string $errMsg, string $file, int $line) {
    throw new \Exception("$errMsg on file $file:$line", 1);
});

$router = new Router();

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$uri = explode('?', $uri);
$uri = $uri[0];

$data = $router->match($method, $uri);
try {
    if($data == null) {
        throw new \Exception("Route Not Found", 1);
    }
    $controller = new $data['controller'];

    $entityBody = file_get_contents('php://input');
    $request = json_decode($entityBody) ?? new stdClass();

    foreach ($_GET as $key => $value) {
        $request->$key = $value;
    }

    $response = call_user_func([$controller,$data['action']],$request);
} catch (\Exception $e) {
    $response = ['message' => $e->getMessage()];
    http_response_code(500);
}

echo json_encode($response);
