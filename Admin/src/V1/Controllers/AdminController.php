<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Controllers;

use SIGA\Core\ControllerAbstract;
use Psr\Http\Message\RequestInterface as Resq;
use Psr\Http\Message\ResponseInterface as Resp;

/**
 * Description of AdminController
 *
 * @author caltj
 */
class AdminController extends ControllerAbstract {

//    protected $TemplatePath = "Home/views";
//    protected $template = 'home';
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


}
