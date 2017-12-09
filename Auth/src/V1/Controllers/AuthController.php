<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;

/**
 * Description of AuthController
 *
 * @author caltj
 */
class AuthController extends \SIGA\Core\ControllerAbstract {

    //put your code here
    protected $table = \SIGA\Auth\V1\Tables\UsuarioTable::class;
    protected $model = \SIGA\Auth\V1\Models\Register::class;
    protected $form = \SIGA\Auth\V1\Form\Usuario::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/login';
    protected $defaultLayout = 'auth';

    public function login(Resq $req, Resp $resp) {
        if ($req->isPost()):
              if ($this->auth->attempt($req->getParam('email'), $req->getParam('password'))):
                $auth = $this->auth->user();
                $this->args['type'] = 'success';
                $this->args['msg'] = sprintf("Ol seja bem vindo <b>%s %s</b>!", $auth['first_name'],  $auth['last_name']);
                $this->args['refresh'] = TRUE;
            endif;
            return $resp->withJson($this->args);
        endif;
        $this->getForm("ajaxForm", [
            'action' => $this->router->pathFor('login'),
        ]);
        return $this->view->render($resp, sprintf("%s/%s", $this->TemplatePath, $this->template), [
                    'data' => $this->Data,
                    'form' => $this->form,
        ]);
    }

    public function register(Resq $req, Resp $resp, $args = []) {
        if ($this->user):
            return $resp->withRedirect($this->router->pathFor('login'));
        endif;
        if ($req->isPost()):
            //Pegamos os dados
            $this->Data = $req->getParams();
            //Pegamos a model a table eo form
            $this->getModel()->getForm()->getTable();
            //setamos o adapter no model
            $this->model->setAdapter($this->getAdapter())->getInputFilter();
            //validamos a model
            $erros = $this->model->validate();
            if ($erros):
                //trata os erros
                $this->args['msg'] = implode(PHP_EOL, $erros);
            else:
                //executa a ação de salvar novo usuario
                $this->args = array_merge($this->args, $this->table->register($this->model));
                //tenta recuperar o usuario cadastrado se cadastrou ja carrega a sessão redireciona para o admin
                $auth = $this->auth->attempt($this->Data['email'], $this->Data['password']);
                if ($auth):
                    $this->args['type'] = 'success';
                    $this->args['msg'] = sprintf("Ol seja bem vindo <b>%s</b>!", $this->Data['first_name']);
                    $this->args['refresh'] = TRUE;
                endif;
            endif;
            return $resp->withJson($this->args);
        endif;
        $this->template = 'auth/register';
        $this->getForm("ajaxForm", [
            'action' => $this->router->pathFor('register', [
                'id' => $args['id'],
            ]),
        ]);
        $this->Data['id'] = $args['id'];
        return $this->view->render($resp, sprintf("%s/%s", $this->TemplatePath, $this->template), [
                    'data' => $this->Data,
                    'form' => $this->form,
        ]);
    }

    public function logout(Resq $req, Resp $resp) {
        $this->auth->logout();
        $this->flash->addMessage('success', "You have been signed out!");
        return $resp->withRedirect($this->router->pathFor('login'));
    }

}
