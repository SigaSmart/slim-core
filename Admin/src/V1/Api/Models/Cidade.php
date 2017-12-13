<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\V1\Api\Models;

use Zend\Db\Sql\Select;
use SIGA\Table\AbstractTable;

/**
 * Description of Cidade
 *
 * @author caltj
 */
class Cidade extends AbstractTable {

    public $config = [
        'name' => 'Lista de cidades',
        //'showButtonsActions' => true,
        //'valueButtonsActions' => ['add'=>"Adicionar",'active'=>'Ativar','inactive'=>"Desabilitar","trash"=>"Enviar p/ Lixeira",'trashall'=>'Esvaziar Lixeira','csv'=>'Exportar'],
        'showPagination' => true,
        'showQuickSearch' => true,
        'showItemPerPage' => true,
        'itemCountPerPage' => 6,
        'numberColls' => 3,
        'showColumnFilters' => true,
        'showExportToCSV' => true,
        'valuesOfItemPerPage' => [6, 12, 24, 48, 90, 180],
        'rowAction' => ''
    ];

    /**
     * @var array Definition of headers
     */
   public $headers = [
		'id' => ['title' => 'check-all', 'width' => 50],
		'cover' => ['title' => 'Cover', 'filters' => 'text'],
		'title' => ['title' => 'Name', 'filters' => 'text'],
		'uf' => ['title' => 'Uf', 'filters' => 'text', 'separatable' => true],
		'ibge' => ['title' => 'Ibge', 'filters' => 'text'],
		'cep' => ['title' => 'Cep', 'filters' => 'text'],
		'status' => ['title' => 'Active', 'width' => 100],
	];

	public function init() {
		
		$this->getHeader('title')->getCell()->addDecorator('link', [
			'url' => $this->View->route->pathFor('cidade.edit', [
				'id' => "%s",
			]),
			'vars' => ['id'],
		])->addCondition('equal', ['column' => 'status', 'values' => '1']);
		$this->getHeader('id')->getCell()->addDecorator('check');
		$this->getHeader('id')->addDecorator('check');
		$this->getHeader('cover')->getCell()->addDecorator('img', [
			'base' => $this->getUrl(),
			'class' => 'img-circle',
			'vars' => ['cover','title','uf']
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
    }

    protected function initFilters(Select $query) {

    }

}