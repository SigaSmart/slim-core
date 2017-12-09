<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Home\V1\Controllers;

use SIGA\Core\ControllerAbstract;
// use SIGA\Home\V1\Tables\HomeTable;
// use SIGA\Home\V1\Models\Home;
// use SIGA\Home\V1\Form\Home as HomeForm;

/**
 * Description of HomeController
 *
 * @author caltj
 */
class HomeController extends ControllerAbstract {

    // protected $table = HomeTable::class;
    // protected $model = Home::class;
    // protected $form =  HomeForm::class;
    protected $TemplatePath = "Home/views";
    protected $template = 'home';
    protected $route = 'home';
    protected $defaultLayout = 'home';

}