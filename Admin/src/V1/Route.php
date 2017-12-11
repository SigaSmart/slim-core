<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1;

use SIGA\Admin\V1\Controllers;
use SIGA\Core\RouteAbstract;

/**
 * Description of Route
 *
 * @author caltj
 */
class Route extends RouteAbstract {

    //put your code here
    public function create() {

        //rotas admin protegidas
        $this->app->group('/admin', function () {
            $this->get("[/]", sprintf("%s:index", Controllers\AdminController::class))->setName('admin');
            $this->get("/setlayout", sprintf("%s:setlayout", Controllers\AdminController::class))->setName('settlayout');
           $this->get("/modal", sprintf("%s:modal", Controllers\AdminController::class))->setName('modal');
           
            $this->group('/cidade', function () {
                $this->get("[/]", sprintf("%s:index", Controllers\CidadeController::class))->setName('cidade');
                $this->post("/create", sprintf("%s:create", Controllers\CidadeController::class))->setName('cidade.create');
                $this->post("/store", sprintf("%s:store", Controllers\CidadeController::class))->setName('cidade.store');
                $this->get("/{id}/edit", sprintf("%s:edit", Controllers\CidadeController::class))->setName('cidade.edit');
            });

            $this->group('/empresa', function () {
                $this->get("[/]", sprintf("%s:index", Controllers\EmpresaController::class))->setName('empresa');
                $this->post("/create", sprintf("%s:create", Controllers\EmpresaController::class))->setName('empresa.create');
                $this->post("/store", sprintf("%s:store", Controllers\EmpresaController::class))->setName('empresa.store');
                $this->get("/{id}/edit", sprintf("%s:edit", Controllers\EmpresaController::class))->setName('empresa.edit');
            });
        })->add($this->app->getContainer()->get('AuthMiddleware'));

        $this->app->group('/api', function () {

            $this->group('/cidade', function () {
                $this->map(['POST', 'GET'], "/", sprintf("%s:listar", Api\Controllers\CidadeController::class))->setName('api.cidade');
                $this->map(['POST', 'GET'], "/{id}/state", sprintf("%s:state", Api\Controllers\CidadeController::class))->setName('cidade.state');
                $this->map(['POST', 'GET'], "/delete", sprintf("%s:delete", Api\Controllers\CidadeController::class))->setName('cidade.delete');
            });
            $this->group('/empresa', function () {
                $this->map(['POST', 'GET'], "/", sprintf("%s:listar", Api\Controllers\EmpresaController::class))->setName('api.empresa');
                $this->map(['POST', 'GET'], "/{id}/state", sprintf("%s:state", Api\Controllers\EmpresaController::class))->setName('empresa.state');
                $this->map(['POST', 'GET'], "/delete", sprintf("%s:delete", Api\Controllers\EmpresaController::class))->setName('empresa.delete');
            });
        })->add($this->app->getContainer()->get('AuthMiddleware'));
    }

}
