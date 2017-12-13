<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Controllers;

use SIGA\Core\ControllerAbstract;
use SIGA\Auth\V1\Tables\ResourceTable;
use SIGA\Auth\V1\Models\Resource;
use SIGA\Auth\V1\Form\Resource as ResourceForm;

/**
 * Description of ResourceController
 *
 * @author caltj
 */
class ResourceController extends ControllerAbstract {

    protected $table = ResourceTable::class;
    protected $model = Resource::class;
    protected $form =  ResourceForm::class;
    protected $TemplatePath = "Auth/views";
    protected $template = 'auth/resource';
    protected $route = 'modulos';

}