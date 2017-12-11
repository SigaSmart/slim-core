<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Form;

/**
 * Description of Role
 *
 * @author caltj
 */
class Role extends \SIGA\Core\Form\AbstractForm {

    public function __construct($name = "AjaxForm", array $options = array()) {
        parent::__construct($name, $options);
        $this->setAttribute('class', "form-horizontal");
        $this->setAttribute('method', "post");
       
        //adicionar os filds

                //*********************** name **************************//
        		$this->add([
                    'type' => \SIGA\Core\Form\Fields\Text::class,
                    'name' => 'name',
                    'options' => [
                        'label' => "Nome\Descrição:"
                    ],
                    'attributes' => [
                        'class' => 'form-control',
                        'placeholder' => 'Nome Descrição:'
                    ]
                ]);

                        //*********************** alias **************************//
                		$this->add([
                            'type' => \SIGA\Core\Form\Fields\Text::class,
                            'name' => 'alias',
                            'options' => [
                                'label' => "Alias:"
                            ],
                            'attributes' => [
                                'class' => 'form-control',
                                'placeholder' => 'Alias:',
                                'readonly'=>true
                            ]
                        ]);
        
    }

}