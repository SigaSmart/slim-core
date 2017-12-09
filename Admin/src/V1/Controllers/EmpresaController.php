<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Controllers;

use SIGA\Admin\V1\Form\Empresa as EmpresaForm;
use SIGA\Admin\V1\Models\Empresa;
use SIGA\Admin\V1\Tables\EmpresaTable;
use SIGA\Core\ControllerAbstract;

/**
 * Description of EmpresaController
 *
 * @author caltj
 */
class EmpresaController extends ControllerAbstract {

	protected $table = EmpresaTable::class;
	protected $model = Empresa::class;
	protected $form = EmpresaForm::class;
	protected $TemplatePath = "Admin/views";
	protected $template = 'admin/empresa';
	protected $route = 'empresa';

}