<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Form;

use SIGA\Core\Form\AbstractForm;

/**
 * Description of Usuario
 *
 * @author caltj
 */
class Usuario extends AbstractForm {

    public function __construct($name = "AjaxForm", array $options = array()) {
        parent::__construct($name, $options);
        $this->setAttribute('class', "form-horizontal");
        $this->add([
            'type' => \SIGA\Core\Form\Fields\Text::class,
            'name' => 'first_name',
            'options' => [
                'label' => "Nome:",
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => "Nome:"
            ],
        ]);
        $this->add([
            'type' => \SIGA\Core\Form\Fields\Text::class,
            'name' => 'last_name',
            'options' => [
                'label' => "Sobre Nome:",
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => "Sobre Nome:"
            ],
        ]);

        $this->add([
            'type' => \SIGA\Core\Form\Fields\Text::class,
            'name' => 'cover',
            'options' => [
                'label' => "Imagem:",
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => "no image:",
                'readonly' => TRUE,
            ],
        ]);

        $this->add([
            'type' => \SIGA\Core\Form\Fields\Email::class,
            'name' => 'email',
            'options' => [
                'label' => "E-Mail:",
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => "E-Mail:"
            ],
        ]);
        
        if($this->options['user']['role']=="admin"):
              //*********************** role **************************//
               $this->add([
                        'type' => \SIGA\Core\Form\Fields\Select::class,
                        'name' => 'role',
                        'options' => [
                            'label' => "Nivel de acesso:",
                            'empty' => "--Selecione--",
                            //table: Nome da tabela
                            //Colunas no formato de array ex: ['id' => 'name'] (opcional)
                            //Condição AND ou OR status = ? AND ou OR name = ?
                            //Os value conforme os parametros passsados na condição array [1, 'claudio']
                            'value_options'=> $this->dbValueOptions('roles', ['alias','name'])
                        ],
                        'attributes' => [
                            'class' => 'form-control'
                        ],
                    ]);
        else:
          //*********************** role **************************//
          $this->add([
                    'name' => 'role',
                    'type' => \SIGA\Core\Form\Fields\Hidden::class
                ]);

        endif; 
        $this->add([
            'type' => \SIGA\Core\Form\Fields\Password::class,
            'name' => 'password',
             'options' => [
                'label' => "Senha:",
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => "Senha:",
            ],
        ]);
    }

}
