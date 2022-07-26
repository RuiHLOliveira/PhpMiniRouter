<?php

namespace PhpMiniRouter\Core;

use FluxoDeCaixa\Controller\MovimentosController;
use FluxoDeCaixa\Controller\ContasController;
use FluxoDeCaixa\Controller\TiposMovimentosControllerr;

class Router
{
    public $rotas;

    public function __construct() {
        $this->rotas = [];
        // $this->listagemRotas();
    }

    public function add ($rota) {
        $this->rotas[] = $rota;
    }

    public function match($method, $uri) {
        foreach ($this->rotas as $key => $rota) {
            if($rota->method == $method && $rota->path == $uri)
                return ['controller' => $rota->controller, 'action' => $rota->action];
        }
    }

}
