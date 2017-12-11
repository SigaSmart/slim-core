<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use SIGA\Core\ControllerAbstract;
use SIGA\Auth\V1\Tables\RoleTable;
use SIGA\Auth\V1\Models\Role;
use SIGA\Auth\V1\Form\Role as RoleForm;

/**
 * Description of RoleController
 *
 * @author caltj
 */
class RoleController extends ControllerAbstract {

    protected $table = RoleTable::class;
    protected $model = Role::class;
    protected $form =  RoleForm::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'role';
    protected $route = 'role';

}