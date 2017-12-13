<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Form;

/**
 * Description of Resource
 *
 * @author caltj
 */
class Resource extends \SIGA\Core\Form\AbstractForm {

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
                        'label' => "Nome Descrição:"
                    ],
                    'attributes' => [
                        'class' => 'form-control',
                        'placeholder' => 'Nome Descrição:'
                    ]
                ]);


                          //*********************** alias **************************//
                           $this->add([
                                    'type' => \SIGA\Core\Form\Fields\Select::class,
                                    'name' => 'alias',
                                    'options' => [
                                        'label' => "Controller:",
                                        'empty' => "--Selecione--",
                                        //table: Nome da tabela
                                        //Colunas no formato de array ex: ['id', 'name'] (opcional)
                                        //Condição AND ou OR status = ? AND ou OR name = ?
                                        //Os value conforme os parametros passsados na condição array [1, 'claudio']
                                        'value_options'=> $this->dbValueOptions('menus',['route', 'name'])
                                    ],
                                    'attributes' => [
                                        'class' => 'form-control'
                                    ],
                                ]);
        
    }

}