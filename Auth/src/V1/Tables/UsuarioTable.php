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
 * Description of UsuarioTable
 *
 * @author caltj
 */
class UsuarioTable extends TablesAbstract {

    protected $table = 'users';

    public function insert(ModelAbstract $mode) {
        $mode->offsetSet('first_name', "Novo User");
        $mode->offsetSet('created_at', date("Y-m-d H:i:s"));
        $mode->offsetSet('updated_at', date("Y-m-d H:i:s"));
        return parent::insert($mode);
    }

    public function register(ModelAbstract $mode) {

        $mode->offsetSet('role', 'admin');
        $mode->offsetSet('created_at', date("Y-m-d H:i:s"));
        $mode->offsetSet('updated_at', date("Y-m-d H:i:s"));
        $mode->offsetSet('status', 1);
        return $this->save($mode);
    }

    public function save(ModelAbstract $mode)
    {
        if(!empty($mode->offsetGet('password'))):
            $mode->offsetSet('password', password_hash($mode->offsetGet('password'), PASSWORD_DEFAULT, [
                'cost' => 10
            ]));
        endif;
        return parent::save($mode); // TODO: Change the autogenerated stub
    }


}
