<?php

namespace PhpMiniRouter\Core;

use stdClass;
use PhpMiniRouter\Core\Router;


class Kernel {

    public $router;

    public function __construct()
    {
        $this->defineErrorHandler();
        $this->router = new Router();
    }

    public function start($options = []) {
        $this->handleOptions($options);
        $this->main();
    }

    public function handleOptions($options) {

    }

    public function addRoute($route){
        $this->router->add($route);
    }

    private function defineErrorHandler() {
        set_error_handler(function (int $errNo, string $errMsg, string $file, int $line) {
            throw new \Exception("$errMsg on file $file:$line", 1);
        });
    }

    private function main () {
        
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $uri = explode('?', $uri);
        $uri = $uri[0];
        $data = $this->router->match($method, $uri);

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
        
    }
}