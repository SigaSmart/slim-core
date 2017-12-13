<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use SIGA\Core\ControllerAbstract;
use SIGA\Auth\V1\Tables\PrivilegeTable;
use SIGA\Auth\V1\Models\Privilege;
use SIGA\Auth\V1\Form\Privilege as PrivilegeForm;

/**
 * Description of PrivilegeController
 *
 * @author caltj
 */
class PrivilegeController extends ControllerAbstract {

    protected $table = PrivilegeTable::class;
    protected $model = Privilege::class;
    protected $form =  PrivilegeForm::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/privilege';
    protected $route = 'privilegios';

}