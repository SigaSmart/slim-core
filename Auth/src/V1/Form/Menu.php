<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Form;

/**
 * Description of Menu
 *
 * @author caltj
 */
class Menu extends \SIGA\Core\Form\AbstractForm {

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
                        'placeholder' => 'Nome\Descrição:'
                    ]
                ]);

                  //*********************** parent **************************//
                   $this->add([
                            'type' => \SIGA\Core\Form\Fields\Select::class,
                            'name' => 'parent',
                            'options' => [
                                'label' => "Grupo:",
                                'empty' => "--Selecione--",
                                //table: Nome da tabela
                                //Colunas no formato de array ex: ['id' , 'name'] (opcional)
                                //Condição AND ou OR status = ? AND ou OR name = ?
                                //Os value conforme os parametros passsados na condição array [1, 'claudio']
                                'value_options'=> $this->dbValueOptions('menus', ['id', 'name'], ' AND status = ? AND parent IS NULL ')
                            ],
                            'attributes' => [
                                'class' => 'form-control'
                            ],
                        ]);

                     //*********************** tipo **************************//
                      $this->add([
                               'type' => \SIGA\Core\Form\Fields\Select::class,
                               'name' => 'tipo',
                               'options' => [
                                   'label' => "Tema:",
                                   'empty' => "--Selecione--",
                                   //table: Nome da tabela
                                   //Colunas no formato de array ex: ['id' , 'name'] (opcional)
                                   //Condição AND ou OR status = ? AND ou OR name = ?
                                   //Os value conforme os parametros passsados na condição array [1, 'claudio']
                                   'value_options'=> $this->dbValueOptions('menu_theme',['alias' , 'name'])
                               ],
                               'attributes' => [
                                   'class' => 'form-control'
                               ],
                           ]);

                              //*********************** route **************************//
                      		$this->add([
                                  'type' => \SIGA\Core\Form\Fields\Text::class,
                                  'name' => 'route',
                                  'options' => [
                                      'label' => "Rota:"
                                  ],
                                  'attributes' => [
                                      'class' => 'form-control',
                                      'placeholder' => 'Rota:'
                                  ]
                              ]);

                      		  //*********************** role **************************//
                      		   $this->add([
                      		            'type' => \SIGA\Core\Form\Fields\Select::class,
                      		            'name' => 'role',
                      		            'options' => [
                      		                'label' => "Role:",
                      		                'empty' => "--Selecione--",
                      		                //table: Nome da tabela
                      		                //Colunas no formato de array ex: ['id' => 'name'] (opcional)
                      		                //Condição AND ou OR status = ? AND ou OR name = ?
                      		                //Os value conforme os parametros passsados na condição array [1, 'claudio']
                      		                'value_options'=> $this->dbValueOptions('roles')
                      		            ],
                      		            'attributes' => [
                      		                'class' => 'form-control'
                      		            ],
                      		        ]);

                      		           //*********************** icone **************************//
                      		   		$this->add([
                      		               'type' => \SIGA\Core\Form\Fields\Text::class,
                      		               'name' => 'icone',
                      		               'options' => [
                      		                   'label' => "Icone:"
                      		               ],
                      		               'attributes' => [
                      		                   'class' => 'form-control',
                      		                   'placeholder' => 'fa fa-home:'
                      		               ]
                      		           ]);

                      		   		        //*********************** description **************************//
                      		   				$this->add([
                      		   		            'type' => \SIGA\Core\Form\Fields\Text::class,
                      		   		            'name' => 'description',
                      		   		            'options' => [
                      		   		                'label' => "Dica de tela:"
                      		   		            ],
                      		   		            'attributes' => [
                      		   		                'class' => 'form-control',
                      		   		                'placeholder' => 'Dica de tela:'
                      		   		            ]
                      		   		        ]);

                      		   		          //*********************** ordem **************************//
                      		   		           $this->add([
                      		   		                    'type' => \SIGA\Core\Form\Fields\Select::class,
                      		   		                    'name' => 'ordem',
                      		   		                    'options' => [
                      		   		                        'label' => "Ordem:",
                      		   		                        'empty' => "--Selecione--",
                      		   		                        //table: Nome da tabela
                      		   		                        //Colunas no formato de array ex: ['id' => 'name'] (opcional)
                      		   		                        //Condição AND ou OR status = ? AND ou OR name = ?
                      		   		                        //Os value conforme os parametros passsados na condição array [1, 'claudio']
                      		   		                        'value_options'=> $this->dbValueOptions('menus')
                      		   		                    ],
                      		   		                    'attributes' => [
                      		   		                        'class' => 'form-control'
                      		   		                    ],
                      		   		                ]);
        
    }

}