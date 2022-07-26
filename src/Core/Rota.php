<?php

namespace PhpMiniRouter\Core;

class Rota {
    public $path;
    public $method;
    public $controller;
    public $action;

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    public static function get() {
        return self::build(Rota::GET);
    }
    public static function post() {
        return self::build(Rota::POST);
    }
    public static function put() {
        return self::build(Rota::PUT);
    }
    public static function delete() {
        return self::build(Rota::DELETE);
    }

    private static function build($constant){
        $rota = new Rota();
        $rota->method = $constant;
        return $rota;
    }

    public function path($path){
        $this->path = $path;
        return $this;
    }
    
    public function controller($controller){
        $this->controller = $controller;
        return $this;
    }
    
    public function action($action){
        $this->action = $action;
        return $this;
    }
}