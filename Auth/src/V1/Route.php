<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1;

use SIGA\Auth\V1\Controllers;
use SIGA\Core\RouteAbstract;

/**
 * Description of Route
 *
 * @author caltj
 */
class Route extends RouteAbstract {

    //put your code here
    public function create() {

        $this->app->group('/admin', function () {

            $this->group('/usuario', function () {

                $this->map(['GET', 'POST'], '/login', sprintf('%s:login', Controllers\AuthController::class))->setName('login');

                $this->map(['GET', 'POST'], '/{id}/register', sprintf('%s:register', Controllers\AuthController::class))->setName('register');

                $this->map(['GET', 'POST'], '/empresa', sprintf('%s:empresa', Controllers\EmpresaController::class))->setName('usuario.empresa');

                $this->map(['GET', 'POST'], '/forgot', sprintf('%s:forgot', Controllers\AuthController::class))->setName('forgot');
            });
        })->add($this->app->getContainer()->get('GuestMiddleware'));

        $this->app->group('/admin', function () {

            $this->get('/usuario', sprintf('%s:index', Controllers\UsuarioController::class))->setName('usuario');

            $this->get('/usuario/{id}/edit', sprintf('%s:edit', Controllers\UsuarioController::class))->setName('usuario.edit');

            $this->post('/usuario/store', sprintf('%s:store', Controllers\UsuarioController::class))->setName('usuario.store');

            $this->post('/usuario/create', sprintf('%s:create', Controllers\UsuarioController::class))->setName('usuario.create');

            $this->post('/usuario/password', sprintf('%s:password', Controllers\UsuarioController::class))->setName('usuario.password');

            $this->get("/usuario/logout", sprintf("%s:logout", Controllers\AuthController::class))->setName('usuario.logout');

            $this->map(['GET', 'POST'], "/usuario/profile", sprintf("%s:profile", Controllers\UsuarioController::class))->setName('usuario.profile');
            
               $this->group('/role', function () {
                    $this->get("[/]", sprintf("%s:index", Controllers\RoleController::class))->setName('role');
                    $this->get("/{id}/edit", sprintf("%s:edit", Controllers\RoleController::class))->setName('role.edit');
                    $this->post("/create", sprintf("%s:create", Controllers\RoleController::class))->setName('role.create');
                    $this->post("/store", sprintf("%s:store", Controllers\RoleController::class))->setName('role.store');
                });

                  $this->group('/menu', function () {
                       $this->get("[/]", sprintf("%s:index", Controllers\MenuController::class))->setName('menu');
                       $this->get("/{id}/edit", sprintf("%s:edit", Controllers\MenuController::class))->setName('menu.edit');
                       $this->post("/create", sprintf("%s:create", Controllers\MenuController::class))->setName('menu.create');
                       $this->post("/store", sprintf("%s:store", Controllers\MenuController::class))->setName('menu.store');
                   });

                     $this->group('/menutheme', function () {
                          $this->get("[/]", sprintf("%s:index", Controllers\MenuthemeController::class))->setName('menutheme');
                          $this->get("/{id}/edit", sprintf("%s:edit", Controllers\MenuthemeController::class))->setName('menutheme.edit');
                          $this->post("/create", sprintf("%s:create", Controllers\MenuthemeController::class))->setName('menutheme.create');
                          $this->post("/store", sprintf("%s:store", Controllers\MenuthemeController::class))->setName('menutheme.store');
                      });

              $this->group('/privilegios', function () {
               $this->get("[/]", sprintf("%s:index", Controllers\PrivilegeController::class))->setName('privilegios');
               $this->get("/{id}/edit", sprintf("%s:edit", Controllers\PrivilegeController::class))->setName('privilegios.edit');
               $this->post("/create", sprintf("%s:create", Controllers\PrivilegeController::class))->setName('privilegios.create');
               $this->post("/store", sprintf("%s:store", Controllers\PrivilegeController::class))->setName('privilegios.store');
             });

                 $this->group('/modulos', function () {
                  $this->get("[/]", sprintf("%s:index", Controllers\ResourceController::class))->setName('modulos');
                  $this->get("/{id}/edit", sprintf("%s:edit", Controllers\ResourceController::class))->setName('modulos.edit');
                  $this->post("/create", sprintf("%s:create", Controllers\ResourceController::class))->setName('modulos.create');
                  $this->post("/store", sprintf("%s:store", Controllers\ResourceController::class))->setName('modulos.store');
                });

        })->add($this->app->getContainer()->get('AuthMiddleware'));




        $this->app->group('/api', function () {
            $this->map(['POST', 'GET'], "/usuario", sprintf("%s:listar", Api\Controllers\UsuarioController::class))->setName('api.usuario');
            $this->group('/usuario', function () {
                $this->post("/{id}/state", sprintf("%s:state", Api\Controllers\UsuarioController::class))->setName('usuario.state');
                $this->post("/delete", sprintf("%s:delete", Api\Controllers\UsuarioController::class))->setName('usuario.delete');
            });

        $this->map(['POST', 'GET'], "/role", sprintf("%s:listar", Api\Controllers\RoleController::class))->setName('api.role');
            $this->group('/role', function () {
                $this->post("/{id}/state", sprintf("%s:state", Api\Controllers\RoleController::class))->setName('role.state');
                $this->post("/delete", sprintf("%s:delete", Api\Controllers\RoleController::class))->setName('role.delete');
            });

            $this->map(['POST', 'GET'], "/menu", sprintf("%s:listar", Api\Controllers\MenuController::class))->setName('api.menu');
                        $this->group('/menu', function () {
                            $this->post("/{id}/state", sprintf("%s:state", Api\Controllers\MenuController::class))->setName('menu.state');
                            $this->post("/delete", sprintf("%s:delete", Api\Controllers\MenuController::class))->setName('menu.delete');
                        });
            $this->map(['POST', 'GET'], "/menutheme", sprintf("%s:listar", Api\Controllers\MenuthemeController::class))->setName('api.menutheme');
                        $this->group('/menutheme', function () {
                            $this->post("/{id}/state", sprintf("%s:state", Api\Controllers\MenuthemeController::class))->setName('menutheme.state');
                            $this->post("/delete", sprintf("%s:delete", Api\Controllers\MenuthemeController::class))->setName('menutheme.delete');
                        });

            $this->map(['POST', 'GET'], "/privilegios", sprintf("%s:listar", Api\Controllers\PrivilegeController::class))->setName('api.privilegios');
                  $this->group('/privilegios', function () {
                    $this->post("/{id}/state", sprintf("%s:state", Api\Controllers\PrivilegeController::class))->setName('privilegios.state');
                    $this->post("/delete", sprintf("%s:delete", Api\Controllers\PrivilegeController::class))->setName('privilegios.delete');
                  });

            $this->map(['POST', 'GET'], "/modulos", sprintf("%s:listar", Api\Controllers\ResourceController::class))->setName('api.modulos');
                  $this->group('/modulos', function () {
                    $this->post("/{id}/state", sprintf("%s:state", Api\Controllers\ResourceController::class))->setName('modulos.state');
                    $this->post("/delete", sprintf("%s:delete", Api\Controllers\ResourceController::class))->setName('modulos.delete');
                  });
            
        })->add($this->app->getContainer()->get('AuthMiddleware'));
    }

}
