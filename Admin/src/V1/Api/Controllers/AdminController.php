<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Api\Controllers;

use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;
use SIGA\Core\ControllerAbstract;

/**
 * Description of AdminController
 *
 * @author caltj
 */
class AdminController extends ControllerAbstract {


    protected $TemplatePath = "Admin/views";
    protected $template = 'admin/table';
    protected $route = 'admin';

    public function table(Resq $req, Resp $resp) {
        $params = $req->getParam('file');
        try {
            $this->getAdapter()->query(
                $params,
                $this->adapter::QUERY_MODE_EXECUTE
            );
            $this->args['result'] = true;
            $this->args['msg'] = "Registro Atualizado Com Sucesso!";
            $this->args['type'] = 'success';
        } catch (\Exception $e) {
            $this->args['type'] = "danger";
            $this->args['result'] = FALSE;
            $this->args['msg'] = sprintf("OPSS! %s<br />%s!", $e->getMessage(), $e->getPrevious());
        }

        return $resp->withJson($this->args);

    }

}
