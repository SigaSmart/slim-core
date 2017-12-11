<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Api\Models;

use Zend\Db\Sql\Select;
use SIGA\Table\AbstractTable;

/**
 * Description of Role
 *
 * @author caltj
 */
class Role extends AbstractTable {

    public $config = [
        'name' => 'Lista Nivel De Acesso',
        //'showButtonsActions' => true,
        //'valueButtonsActions' => ['add'=>"Adicionar",'active'=>'Ativar','inactive'=>"Desabilitar","trash"=>"Enviar p/ Lixeira",'trashall'=>'Esvaziar Lixeira','csv'=>'Exportar'],
        'showPagination' => true,
        'showQuickSearch' => true,
        'showItemPerPage' => true,
        'itemCountPerPage' => 10,
        'showColumnFilters' => true,
        'showExportToCSV' => true,
        'valuesOfItemPerPage' => [5, 10, 20, 50, 100, 200],
        'rowAction' => ''
    ];

    /**
     * @var array Definition of headers
     */
    public $headers = [
        'id' => ['title' => 'check-all', 'width' => 50],
        'name' => ['title' => 'Nome\Descrição', 'filters' => 'text'],
        'status' => ['title' => 'Active', 'width' => 80],
    ];

    public function init() {
        $this->getHeader('name')->getCell()->addDecorator('link', [
            'url' => $this->View->route->pathFor('role.edit', [
                'id' => "%s"
            ]),
            'vars' => ['id']
        ])->addCondition('equal', ['column' => 'status', 'values' => '1']);
			
		$this->getHeader('status')->getCell()->addDecorator('state', [
            'value' => [
                '1' => 'Active',
                '2' => 'Desactive',
                '3' => 'Trash',
            ],
            'class' => [
                '1' => 'green',
                '2' => 'yellow',
                '3' => 'red',
            ]
        ]);
        $this->getHeader('id')->getCell()->addDecorator('check');
        $this->getHeader('id')->addDecorator('check');
    }

    protected function initFilters(Select $query) {
        
    }

}