<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;
use SIGA\Auth\V1\Form\Usuario as UsuarioForm;
use SIGA\Auth\V1\Models\Usuario;
use SIGA\Auth\V1\Tables\UsuarioTable;
use SIGA\Core\ControllerAbstract;

/**
 * Description of UsuarioController
 *
 * @author caltj
 */
class UsuarioController extends ControllerAbstract {

    protected $table = UsuarioTable::class;
    protected $model = Usuario::class;
    protected $form = UsuarioForm::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth';
    protected $route = 'usuario';

    public function profile(Resq $req, Resp $resp) {
        if ($req->isPost()):
            return parent::store($req, $resp);
        endif;
        $this->Data = $this->auth->user();
        $this->getModel();
        $this->getForm("ajaxForm", [
            'action' => $this->router->pathFor('usuario.store'),
            'user' => $this->user,
        ]);
        return $this->view->render($resp, sprintf("%s/auth/profile", $this->TemplatePath, $this->template), [
                    'data' => $this->Data,
                    'form' => $this->form
        ]);
    }

}
