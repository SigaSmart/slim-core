<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Tables;

use SIGA\Core\ModelAbstract;
use SIGA\Core\TablesAbstract;

/**
 * Description of CidadeTable
 *
 * @author caltj
 */
class CidadeTable extends TablesAbstract {

	protected $table = 'cidades';

	public function insert(ModelAbstract $mode) {
		$mode->offsetSet('name', "Novo Cidade");
		$mode->offsetSet('created_at', date("Y-m-d H:i:s"));
		$mode->offsetSet('updated_at', date("Y-m-d H:i:s"));
		return parent::insert($mode);
	}

}