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
 * Description of RoleTable
 *
 * @author caltj
 */
class RoleTable extends TablesAbstract {

    protected $table = 'roles';

    public function insert(ModelAbstract $mode) {
        $mode->offsetSet('name', "Novo(a) Role");
        $mode->offsetSet('created_at', date("Y-m-d H:i:s"));
        $mode->offsetSet('updated_at', date("Y-m-d H:i:s"));
        //Descomentar se ouver url amigavel
        $mode->offsetSet('alias', $this->slugExists('alias', $mode->offsetGet("name"), $mode->offsetGet("id")));
        return parent::insert($mode);
    }

    public function save(ModelAbstract $mode) {
        $mode->offsetSet('updated_at', date("Y-m-d H:i:s"));
        //Descomentar se ouver url amigavel
        $mode->offsetSet('alias', $this->slugExists('alias', $mode->offsetGet("name"), $mode->offsetGet("id")));
        $this->Result['inputs'] = [
            'alias' => $mode->offsetGet('alias')
        ];
        return parent::save($mode);
    }


}