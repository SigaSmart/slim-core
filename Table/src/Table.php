<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Table;

/**
 * Description of Table
 *
 * @author caltj
 */
class Table extends \SIGA\Core\Form\AbstractForm {
    
    public function __construct($name = "AjaxForm", array $options = array()) {
        parent::__construct($name, $options);
        
    }
}
