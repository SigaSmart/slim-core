<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use SIGA\Core\ControllerAbstract;
use SIGA\Auth\V1\Tables\MenuthemeTable;
use SIGA\Auth\V1\Models\Menutheme;
use SIGA\Auth\V1\Form\Menutheme as MenuthemeForm;

/**
 * Description of MenuthemeController
 *
 * @author caltj
 */
class MenuthemeController extends ControllerAbstract {

    protected $table = MenuthemeTable::class;
    protected $model = Menutheme::class;
    protected $form =  MenuthemeForm::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/menutheme';
    protected $route = 'menutheme';

}