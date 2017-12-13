<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 13/12/2017
 * Time: 11:58
 */

namespace SIGA\Auth\V1\Permission;


use SIGA\Core\TablesAbstract;

class Roles extends  TablesAbstract  {

	protected $table = 'roles';


	public function roles(){
		$roles = $this->getSelect();
		$roles->order(['id'=>"DESC"]);
		$this->Stmt = $this->Sql->prepareStatementForSqlObject($roles);
		$this->exec();
		if ($this->resultSet->count()):
			return $this->resultSet->toArray();
		endif;
		return [];
	}
}