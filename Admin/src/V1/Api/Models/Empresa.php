<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Api\Models;

use SIGA\Table\AbstractTable;
use Zend\Db\Sql\Select;

/**
 * Description of Empresa
 *
 * @author caltj
 */
class Empresa extends AbstractTable {

    public $config = [
        'name' => 'Lista De Empresas',
        'showPagination' => true,
        'showQuickSearch' => true,
        'showItemPerPage' => true,
        'itemCountPerPage' => 10,
        'showColumnFilters' => true,
        'showExportToCSV' => true,
        'valuesOfItemPerPage' => [5, 10, 20, 50, 100, 200],
        'rowAction' => '',
    ];

    /**
     * @var array Definition of headers
     */
    public $headers = array(
        'id' => array('title' => 'check-all', 'width' => 50),
        'social' => array('title' => 'Nome\Descrição', 'filters' => 'text'),
        'tipo' => array('title' => 'Tipo', 'filters' => 'text', 'width' => 130),
        'phone' => array('title' => 'Fone', 'filters' => 'text', 'width' => 150),
        'email' => array('title' => 'E-Mail', 'filters' => 'text', 'width' => 120),
        'status' => array('title' => 'Active', 'width' => 80),
    );

    public function init() {
        $this->getHeader('social')->getCell()->addDecorator('link', [
            'url' => $this->View->route->pathFor('empresa.edit', [
                'id' => "%s",
            ]),
            'vars' => ['id'],
        ])->addCondition('equal', ['column' => 'status', 'values' => '1']);

        $this->getHeader('tipo')->getCell()->addDecorator('mapper', [
            '1' => 'Matriz',
            '2' => 'Filial',
        ]);
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
            ],
        ]);
        $this->getHeader('id')->getCell()->addDecorator('check');
        $this->getHeader('id')->addDecorator('check');
    }

    protected function initFilters(Select $query) {
        
    }

}
