<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Form;

/**
 * Description of Empresa
 *
 * @author caltj
 */
class Empresa extends \SIGA\Core\Form\AbstractForm {

    public function __construct($name = "AjaxForm", array $options = array()) {
        parent::__construct($name, $options);
        $this->setAttribute('class', "form-horizontal");
        $this->setAttribute('method', "post");
       
        //adicionar os filds
                //*********************** social **************************//
        		$this->add([
                    'type' => \SIGA\Core\Form\Fields\Text::class,
                    'name' => 'social',
                    'options' => [
                        'label' => "Nome\Razão Social:"
                    ],
                    'attributes' => [
                        'class' => 'form-control',
                        'placeholder' => 'Nome\Razão Social:'
                    ]
                ]);

                        //*********************** fantasia **************************//
                		$this->add([
                            'type' => \SIGA\Core\Form\Fields\Text::class,
                            'name' => 'fantasia',
                            'options' => [
                                'label' => "Nome\Fantasia:"
                            ],
                            'attributes' => [
                                'class' => 'form-control',
                                'placeholder' => 'Nome Fantasia:'
                            ]
                        ]);

                                //*********************** email **************************//
                        		$this->add([
                                    'type' => \SIGA\Core\Form\Fields\Text::class,
                                    'name' => 'email',
                                    'options' => [
                                        'label' => "E-Mail:"
                                    ],
                                    'attributes' => [
                                        'class' => 'form-control',
                                        'placeholder' => 'E-Mail:'
                                    ]
                                ]);

                                        //*********************** phone **************************//
                                		$this->add([
                                            'type' => \SIGA\Core\Form\Fields\Text::class,
                                            'name' => 'phone',
                                            'options' => [
                                                'label' => "Telefone:"
                                            ],
                                            'attributes' => [
                                                'class' => 'form-control',
                                                'placeholder' => 'Telefone:'
                                            ]
                                        ]);
    }

}