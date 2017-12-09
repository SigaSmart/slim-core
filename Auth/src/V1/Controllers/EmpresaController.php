<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;
use SIGA\Auth\V1\Form\Empresa as EmpresaForm;
use SIGA\Auth\V1\Models\Empresa;
use SIGA\Auth\V1\Tables\EmpresaTable;
use SIGA\Core\ControllerAbstract;

/**
 * Description of EmpresaController
 *
 * @author caltj
 */
class EmpresaController extends ControllerAbstract {

    protected $table = EmpresaTable::class;
    protected $model = Empresa::class;
    protected $form = EmpresaForm::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/empresa';
    protected $route = 'empresa';
    protected $defaultLayout = 'auth';

    public function empresa(Resq $req, Resp $resp) {
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
                $this->args = array_merge($this->args, $this->table->insert($this->model));
                //tenta recuperar o usuario cadastrado se cadastrou ja carrega a sessão redireciona para o admin
                $this->args['msg'] = sprintf("Vamos para o proximo passo <b>%s</b>!", $this->Data['social']);
                $this->args['title'] = "OPA!";
                $this->args['redirect'] = $this->router->pathFor('register', [
                    'id' => $this->args['result']
                ]);

            endif;
            return $resp->withJson($this->args);
        endif;
        $this->getForm("ajaxForm", [
            'action' => $this->router->pathFor('usuario.empresa'),
        ]);
        return $this->view->render($resp, sprintf("%s/%s", $this->TemplatePath, $this->template), [
                    'data' => $this->Data,
                    'form' => $this->form,
        ]);
    }

}
