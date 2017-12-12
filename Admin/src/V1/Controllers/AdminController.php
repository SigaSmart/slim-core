<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Controllers;

use SIGA\Admin\V1\Form\Table;
use SIGA\Core\ControllerAbstract;
use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;

/**
 * Description of AdminController
 *
 * @author caltj
 */
class AdminController extends ControllerAbstract {

//    protected $TemplatePath = "Admin/views";
//    protected $template = 'admin/table';
//    protected $defaultLayout = 'home';


public function setlayout(Resq $request, Resp $response , $arsg=[]){

    $params = $request->getParams();
    if(isset($params['l'])):
        $_SESSION['l'] = $params['l'];
    else:
       unset( $_SESSION['l']);
    endif;
    return $response->withRedirect($this->router->pathFor('admin'));
}

    public function table(Resq $req, Resp $resp)
    {
        die;
        $this->TemplatePath = "Admin/views";
        $this->template = 'admin/table';
        $this->form = Table::class;
        $this->getForm("ajaxForm", [
            'action' => $this->router->pathFor('api.table'),
        ]);
        return $this->view->render($resp, sprintf("%s/%s/table", $this->TemplatePath, $this->template), [
            'form' => $this->form,
        ]);
    }


}
