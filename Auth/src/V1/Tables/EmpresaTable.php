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
		$Result = $this->Result;
		parent::insert($mode);
                if($this->Result['result']):
                    $mode->offsetSet('id', $this->Result['result']);
                    $mode->offsetSet('empresa', $this->Result['result']);
                    $Result =  parent::save($mode);
                    if($Result['result']):
                        $this->table = 'roles';
                        $mode->offsetUnset('id');
                        $mode->offsetUnset('social');
                        $mode->offsetUnset('fantasia');
                        $mode->offsetUnset('email');
                        $mode->offsetUnset('phone');
                        $mode->offsetSet('empresa', $this->Result['result']);
                        $mode->offsetSet('name', "Admin");
                        $mode->offsetSet('alias', "admin");
                        $mode->offsetSet('status', "1");
                        parent::save($mode);
                    endif;
                endif;

                return $Result;
	}

}