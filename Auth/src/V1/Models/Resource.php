<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Models;

use SIGA\Core\ModelAbstract;
use Zend\InputFilter\InputFilter;
/**
 * Description of Resource
 *
 * @author caltj
 */
class Resource extends ModelAbstract {

    public function __construct($input = array(), $flags = self::STD_PROP_LIST, $iteratorClass = 'ArrayIterator') {
        parent::__construct($input, $flags, $iteratorClass);
       
    }

    public function getInputFilter() {
        if (!$this->inputFilter):
            $this->inputFilter = new InputFilter();
           
        endif;
        return parent::getInputFilter();
    }

}