<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Api\Models;

use SIGA\Table\AbstractTable;
use Zend\Db\Sql\Select;

/**
 * Description of Usuario
 *
 * @author caltj
 */
class Usuario extends AbstractTable {

	public $config = [
		'name' => 'Lista de ususrios',
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
	public $headers = [
		'id' => ['title' => 'check-all', 'width' => 50],
		'first_name' => ['title' => 'Nome', 'filters' => 'text'],
		'last_name' => ['title' => 'Sobre Nome', 'filters' => 'text'],
		'email' => ['title' => 'E-Mail', 'filters' => 'text'],
		'status' => ['title' => 'Active', 'width' => 100],
	];

	public function init() {
		$this->getHeader('first_name')->getCell()->addDecorator('link', [
			'url' => $this->View->route->pathFor('usuario.edit', [
				'id' => "%s",
			]),
			'vars' => ['id'],
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
			],
		]);
		$this->getHeader('id')->getCell()->addDecorator('check');
		$this->getHeader('id')->addDecorator('check');
	}

	protected function initFilters(Select $query) {

	}

}