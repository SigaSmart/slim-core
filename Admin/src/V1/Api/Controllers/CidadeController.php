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
use Zend\Stdlib\ArrayObject;

/**
 * Description of CidadeController
 *
 * @author caltj
 */
class CidadeController extends ControllerAbstract {

    protected $table = \SIGA\Admin\V1\Tables\CidadeTable::class;
    protected $TableModel = \SIGA\Admin\V1\Api\Models\Cidade::class;
    protected $model = \SIGA\Admin\V1\Models\Cidade::class;
    protected $TemplatePath = "Admin/views";
    protected $template = 'cidade';
    protected $route = 'cidade';

    public function listar(Resq $req, Resp $resp) {
        $params = $req->getParams();
        $this->getModel()->getTableModel();
        if ($this->TableModel):
            //Se for usar o filtro por empresa descomentar essa linha
            //$this->model->offsetSet('empresa', $this->user['empresa']);
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
