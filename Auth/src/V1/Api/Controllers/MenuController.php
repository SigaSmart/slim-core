<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Api\Controllers;

use Zend\Stdlib\ArrayObject;
use SIGA\Core\ControllerAbstract;
use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;

/**
 * Description of MenuController
 *
 * @author caltj
 */
class MenuController extends ControllerAbstract {

    protected $table = \SIGA\Auth\V1\Tables\MenuTable::class;
    protected $TableModel = \SIGA\Auth\V1\Api\Models\Menu::class;
    protected $model = \SIGA\Auth\V1\Models\Menu::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/menu';
    protected $route = 'menu';

    public function listar(Resq $req, Resp $resp) {
        $params = $req->getParams();
        $this->getModel()->getTableModel();
        if ($this->TableModel):
            //Se for usar o filtro por empresa descomentar essa linha
            $this->model->offsetSet('empresa', $this->session->get('restrito', 'default'));
            $this->getTable();
            if ($this->table):
               $this->Data = $this->table->setTableModel($this->TableModel)->setModel($this->model)->getSelect($params);
               $object = new ArrayObject($params);
                $this->TableModel->setSource($this->Data)
                        ->setAdapter($this->adapter)
                        ->setView($this->view)
                        ->setParamAdapter($object);
                return $this->TableModel->render($this->route);
            endif;
        endif;
        return parent::notFound($req, $resp);
    }
}