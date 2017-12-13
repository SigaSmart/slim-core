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
 * Description of PrivilegeController
 *
 * @author caltj
 */
class PrivilegeController extends ControllerAbstract {

    protected $table = \SIGA\Auth\V1\Tables\PrivilegeTable::class;
    protected $TableModel = \SIGA\Auth\V1\Api\Models\Privilege::class;
    protected $model = \SIGA\Auth\V1\Models\Privilege::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/privilege';
    protected $route = 'privilegios';

    public function listar(Resq $req, Resp $resp) {
        $params = $req->getParams();
        $this->getModel()->getTableModel();
        if ($this->TableModel):
            //Se for usar o filtro por empresa descomentar essa linha
            $this->model->offsetSet('empresa', $this->session->get('restrito', 'default'));
            //se for usar a leitura em blocos descomente essa linha
             //O arquivo ex:lista.phtml vai ficar na pasta da views junto com a index e a edit
             //$this->view->setTemplatePathCuston(sprintf("%s/%s/lista", $this->TemplatePath, $this->template));
            $this->getTable();
            if ($this->table):
               $this->Data = $this->table->setTableModel($this->TableModel)->setModel($this->model)->getSelect($params);
               $object = new ArrayObject($params);
                $this->TableModel->setSource($this->Data)
                        ->setAdapter($this->adapter)
                        ->setView($this->view)
                        ->setParamAdapter($object);
                //se for usar a leitura em blocos use essa linha DESCOMNENTE
                //return $this->TableModel->render($this->route,'newDataTableJson');
                //se for usar a leitura em tabela use essa linha  DESCOMNENTE
                return $this->TableModel->render($this->route);
            endif;
        endif;
        return parent::notFound($req, $resp);
    }
}