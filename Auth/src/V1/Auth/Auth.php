<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Auth;

/**
 * Description of Auth
 *
 * @author caltj
 */
class Auth {

    private $container;
    private $session;
    private $users;
    private $empresas;

    public function __construct(\Slim\Container $container) {

        $this->container = $container;
        $this->session = $this->container->session;
        $this->users = new \SIGA\Auth\V1\Tables\UsuarioTable($this->container->get("adapter"));
        $this->empresas = new \SIGA\Auth\V1\Tables\EmpresaTable($this->container->get("adapter"));
    }

    public function user() {

        if (!$this->check()):
            return [];
        endif;
        $user = $this->users->find($this->session->get('user', 'default'), ["*"]);
        return $user;
    }

    public function empresa() {

        if (!$this->check()):
            return [];
        endif;
        if (!is_array($this->session->get('empresa', 'default'))):
            $empresas = $this->empresas->find($this->session->get('empresa', 'default'), ["*"]);
            $this->session->set('empresa', $empresas);
        else:
            $empresas = $this->session->get('empresa', 'default');
            if($empresas && $empresas['tipo'] == 1):
                $result = $this->empresas->select(['empresa' => $empresas['id']],'empresa', ["id"]);
                $params=[];
                if($result):
                    foreach ($result as  $item):
                        $params[]=array_values($item)[0];
                    endforeach;
                endif;
                $this->session->set('restrito', $params);
            else:
                $this->session->set('restrito', $empresas['id']);
            endif;
        endif;
        return $empresas;
    }

    public function check() {

        return $this->session->exists('user');
    }

    public function attempt($email, $password) {

        $user = $this->users->findOneBy(['email' => $email]);
        if (!$user):

            return FALSE;

        endif;

        if (password_verify($password, $user['password'])):

            $this->session->set('user', $user['id']);
            $this->session->set('empresa', $user['empresa']);

            return TRUE;

        endif;

        return FALSE;
    }

    public function logout() {

        // Destroy session
        $this->session::destroy();
    }

}
