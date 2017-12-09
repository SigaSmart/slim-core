<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

/**
 * Description of ModelAbstract
 *
 * @author caltj
 */
class ModelAbstract extends \Zend\Stdlib\ArrayObject {

    /**
     *
     * @var \Zend\InputFilter\InputFilter
     */
    public $inputFilter;
    
    protected $adapter;

    public function __construct($input = array(), $flags = self::STD_PROP_LIST, $iteratorClass = 'ArrayIterator') {
        parent::__construct($input, $flags, $iteratorClass);
    }

    public function validate() {
        $Errors=[];
        $this->inputFilter->setData($this->getArrayCopy());
        if ($this->inputFilter->isValid()):
            return FALSE;
        endif;
        if ($this->inputFilter->getMessages()):
            foreach ($this->inputFilter->getMessages() as $filter => $messages):
                foreach ($messages as $message):
                   // $Errors[] = sprintf("%s: %s", $filter, $message);
                    $Errors[] = sprintf(": %s", $message);
                endforeach;
            endforeach;
        endif;
        return $Errors;
    }
    
    public function getInputFilter() {
        return $this->inputFilter;
    }
    public function getAdapter() {
        return $this->adapter;
    }
    public function setAdapter($adapter) {
        $this->adapter = $adapter;
        return $this;
    }

}
