<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;
use Slim\Container;

/**
 * Description of ControllerAbstract
 *
 * @author caltj
 */
class ControllerAbstract {

    protected $c;
    protected $args = [
        'icon' => 'fa fa-warning',
        'title' => 'OPPSS!',
        'msg' => 'Could not sign in with those details.',
        'type' => 'danger',
    ];
    protected $Data = [];
    protected $table;
    protected $TableModel;
    protected $model;
    protected $insert;
    protected $update;
    protected $delete;
    protected $form;
    protected $TemplatePath = "Admin/views";
    protected $template = 'admin';
    protected $defaultLayout = 'layout-top';
    protected $Layout = true;
    protected $user;
    protected $route = 'admin';
    protected $cover = 'cover';

    /**
     * ControllerAbstract constructor.
     * @param Container $c
     */
    public function __construct(Container $c) {
        $this->c = $c;
        if(isset($_SESSION['l'])):
            $this->view->setLayout($_SESSION['l']);
        else:
            $this->view->setLayout($this->defaultLayout);
        endif;

        $this->user = $this->auth->user();
        $this->view->setTerminal($this->Layout);
    }

    public function index(Resq $req, Resp $resp) {
        return $this->view->render($resp, sprintf("%s/%s/index", $this->TemplatePath, $this->template), [
            'data' => $this->Data,
        ]);
    }

    /**
     * Criar novos registros
     * @param Resq $req
     * @param Resp $resp
     */
    public function create(Resq $req, Resp $resp) {
        if (!$this->model):
            $this->args['msg'] = sprintf("Nenhuma model valida foi passada <b>%s</b>!", $this->user['first_name']);
            return $resp->withJson($this->args);
        endif;
        if (!$this->table):
            $this->args['msg'] = sprintf("Nenhuma table valida foi passada <b>%s</b>!", $this->user['first_name']);
            return $resp->withJson($this->args);
        endif;
        $this->getModel()->getTable();
        $this->model->offsetSet('empresa', $this->user['empresa']);
        $this->args = array_merge($this->args, $this->table->insert($this->model));
        if ($this->args['result']):
            $this->args['redirect'] = $this->router->pathFor(sprintf("%s.edit", $this->route), [
                'id' => $this->args['result'],
            ]);
        endif;
        return $resp->withJson($this->args);
    }

    /**
     * Editar um registro
     * @param Resq $req
     * @param Resp $resp
     */
    public function edit(Resq $req, Resp $resp, $args = []) {
        if (isset($args['id'])):
            $this->getModel();
            if ($this->model):
                $this->getTable();
                if ($this->table):
                    $this->Data = $this->table->find($args['id']);
                    $this->getForm("ajaxForm", [
                        'action' => $this->router->pathFor(sprintf('%s.store', $this->route)),
                    ]);

                    return $this->view->render($resp, sprintf("%s/%s/edit", $this->TemplatePath, $this->template), [
                        'data' => $this->Data,
                        'form' => $this->form,
                    ]);
                endif;
            endif;
        endif;
        return $this->notFound($req, $resp);
    }

    /**
     * Deletar um registro
     * @param Resq $req
     * @param Resp $resp
     */
    public function store(Resq $req, Resp $resp) {
        if (!$this->model):
            $this->args['msg'] = sprintf("Nenhuma model valida foi passada <b>%s</b>!", $this->user['first_name']);
            return $resp->withJson($this->args);
        endif;
        if (!$this->table):
            $this->args['msg'] = sprintf("Nenhuma table valida foi passada <b>%s</b>!", $this->user['first_name']);
            return $resp->withJson($this->args);
        endif;
        if (!$this->form):
            $this->args['msg'] = sprintf("Nenhum form valido foi passada <b>%s</b>!", $this->user['first_name']);
            return $resp->withJson($this->args);
        endif;
        //Pegamos os dados
        $this->Data = $req->getParams();

        if (!$this->Data):
            $this->args['msg'] = sprintf("Nenhum parametro valido foi passada <b>%s</b>!", $this->user['first_name']);
            return $resp->withJson($this->Data);
        endif;
        //Pegamos a model a table eo form
        $this->getModel()->getForm()->getTable();
        $uploadedFiles = $req->getUploadedFiles();
        if ($uploadedFiles):
            // handle single input with single file upload
            $Upload = new UploadAbstract($uploadedFiles['attachment']);
            $this->model->offsetSet($this->cover, $Upload->moveUploadedFile());
        endif;
        //setamos o adapter no model
        $this->model->setAdapter($this->getAdapter())->getInputFilter();
        //validamos a model
        $erros = $this->model->validate();
        if ($erros):
            $this->args['msg'] = implode("</ br>", $erros);
        else:
            $this->args = array_merge($this->args, $this->table->save($this->model));
        endif;
        return $resp->withJson($this->args);
    }

    public function delete(Resq $req, Resp $resp) {
        $this->getTable();
        $this->args = array_merge($this->args, $this->table->delete($req->getParam('id')));
        return $resp->withJson($this->args);
    }

    public function state(Resq $req, Resp $resp, $args = []) {
        $this->getTable();
        $this->args = array_merge($this->args, $this->table->state(['status' => $args['id']], $req->getParam('id')));
        return $resp->withJson($this->args);
    }

    public function notFound(Resq $req, Resp $resp) {
        return $this->view->render($resp, "Admin/views/admin/404", [
            'data' => $this->Data,
        ]);
    }

    public function getTable() {
        if (!empty($this->table)):
            $this->table = (new \ReflectionClass($this->table))->newInstanceArgs([$this->getAdapter()]);
        endif;
        return $this;
    }

    public function getModel() {
        if (!empty($this->model)):
            $this->model = (new \ReflectionClass($this->model))->newInstance();
        endif;
        return $this;
    }

    public function getTableModel() {
        if (!empty($this->TableModel)):
            $this->TableModel = (new \ReflectionClass($this->TableModel))->newInstance();
        endif;
        return $this;
    }

    public function getForm($name = "AjaxForm", array $Options = []) {
        if (!empty($this->form)):
            $Options = array_merge($Options,
                [
                    'adapter' => $this->getAdapter(),
                    'empresa' => isset($this->user['empresa'])? $this->user['empresa'] : "",
                    'user' => $this->user
                ]);
            $this->form = (new \ReflectionClass($this->form))->newInstanceArgs([$name, $Options]);
            if ($this->Data):
                $this->form->setData($this->Data);
                $this->model->exchangeArray($this->form->getData());
            endif;
        endif;
        return $this;
    }

    public function getAdapter() {
        return $this->adapter;
    }

    public function __get($name) {

        if ($this->c->{$name}) {

            return $this->c->{$name};
        }
    }

}
