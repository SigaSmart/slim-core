<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use SIGA\Core\ControllerAbstract;
use SIGA\Auth\V1\Tables\MenuTable;
use SIGA\Auth\V1\Models\Menu;
use SIGA\Auth\V1\Form\Menu as MenuForm;

/**
 * Description of MenuController
 *
 * @author caltj
 */
class MenuController extends ControllerAbstract {

    protected $table = MenuTable::class;
    protected $model = Menu::class;
    protected $form =  MenuForm::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/menu';
    protected $route = 'menu';

}