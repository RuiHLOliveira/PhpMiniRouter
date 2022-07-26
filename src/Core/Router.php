<?php

namespace FluxoDeCaixa\Core;

use FluxoDeCaixa\Controller\MovimentosController;
use FluxoDeCaixa\Controller\ContasController;
use FluxoDeCaixa\Controller\TiposMovimentosControllerr;

class Router
{
    public $rotas;

    public function __construct() {
        $this->rotas = [];
        $this->listagemRotas();
    }

    public function add ($rota) {
        $this->rotas[] = $rota;
    }

    public function listagemRotas () {
        $this->add(Rota::get()->path('/contas')->controller(ContasController::class)->action('index'));
        $this->add(Rota::post()->path('/contas')->controller(ContasController::class)->action('create'));
        $this->add(Rota::get()->path('/tiposmovimentos')->controller(TiposMovimentosControllerr::class)->action('index'));
        $this->add(Rota::post()->path('/tiposmovimentos')->controller(TiposMovimentosControllerr::class)->action('create'));
        $this->add(Rota::get()->path('/movimentos')->controller(MovimentosController::class)->action('index'));
        $this->add(Rota::post()->path('/movimentos')->controller(MovimentosController::class)->action('create'));
    }


    public function match($method, $uri) {
        foreach ($this->rotas as $key => $rota) {
            if($rota->method == $method && $rota->path == $uri)
                return ['controller' => $rota->controller, 'action' => $rota->action];
        }
    }

}
