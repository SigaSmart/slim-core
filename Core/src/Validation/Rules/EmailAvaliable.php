<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use SIGA\Core\Drivers\MySqlDriver;
/**
 * Description of EmailAvaliable
 *
 * @author caltj
 */
class EmailAvaliable extends AbstractRule {
    //put your code here
   
     private $table;

    public function __construct(MySqlDriver $table) {

        $this->table = $table;
    }
    public function validate($input) {
        return !$this->model->findBy($input)->count();
    }

}
