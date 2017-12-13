<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 13/12/2017
 * Time: 11:58
 */

namespace SIGA\Auth\V1\Permission;


use SIGA\Core\TablesAbstract;

class Privileges extends  TablesAbstract {

	protected $table = 'privilegios';


	public function privileges(){
		$privilegios = $this->getSelect();
		$privilegios->order(['id'=>"DESC"]);
		$this->Stmt = $this->Sql->prepareStatementForSqlObject($privilegios);
		$this->exec();
		if ($this->resultSet->count()):
			return $this->resultSet->toArray();
		endif;
		return [];
	}
}