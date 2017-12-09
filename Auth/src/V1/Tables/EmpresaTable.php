<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Tables;

use SIGA\Core\ModelAbstract;
use SIGA\Core\TablesAbstract;

/**
 * Description of EmpresaTable
 *
 * @author caltj
 */
class EmpresaTable extends TablesAbstract {

	protected $table = 'empresa';

	public function insert(ModelAbstract $mode) {
		$mode->offsetSet('created_at', date("Y-m-d H:i:s"));
		$mode->offsetSet('updated_at', date("Y-m-d H:i:s"));
		parent::insert($mode);
                if($this->Result['result']):
                    $mode->offsetSet('id', $this->Result['result']);
                    $mode->offsetSet('empresa', $this->Result['result']);
                    return parent::save($mode);
                endif;
	}

}