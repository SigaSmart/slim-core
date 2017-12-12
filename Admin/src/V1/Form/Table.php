<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Form;

/**
 * Description of Table
 *
 * @author caltj
 */
class Table extends \SIGA\Core\Form\AbstractForm {

    public function __construct($name = "AjaxForm", array $options = array()) {
        parent::__construct($name, $options);
        $this->setAttribute('class', "form-horizontal");
        $this->setAttribute('method', "post");
       
        //adicionar os filds
                //*********************** file **************************//
        		$this->add([
                    'type' => \SIGA\Core\Form\Fields\Textarea::class,
                    'name' => 'file',
                    'options' => [
                        'label' => "Instrução sql:"
                    ],
                    'attributes' => [
                        'class' => 'form-control',
                        'placeholder' => 'Escreva ou cole uma instrução sql:'
                    ]
                ]);
        
    }

}