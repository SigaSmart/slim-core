<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 13/12/2017
 * Time: 11:59
 */

namespace SIGA\Auth\V1\Permission;


use SIGA\Core\TablesAbstract;

class Resources extends  TablesAbstract {

	protected $table = 'menus';

	public function resources(){
		$resources = $this->getSelect();
		$resources->order(['id'=>"DESC"]);
		$this->Stmt = $this->Sql->prepareStatementForSqlObject($resources);
		$this->exec();
		if ($this->resultSet->count()):
			return $this->resultSet->toArray();
		endif;
		return [];
	}

}