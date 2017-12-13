<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 13/12/2017
 * Time: 14:24
 */

namespace SIGA\Core;
use Zend\Permissions\Acl\Acl as ZendAcl,
	Zend\Permissions\Acl\Role\GenericRole as Role,
	Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Acl extends ZendAcl {
    protected $is_admin;
    protected $parent;

    /**
	 * Constructor
	 *
	 * @param Modulos e Privileges
	 * @return void
	 */
    public function __construct(array $roles, array $resources, array $privileges) {
	$this->_addRoles($roles)
		->_addAclRules($resources, $privileges);
}

    /**
	 * Adds Roles to ACL
	 * @param type $roles
	 * @return Acl
	 */
    protected function _addRoles($roles) {
	//Garante a ordens das roles
	//Adidiona as roles
	foreach ($roles as  $value) {
		//Verifica a role ja foi add
		if (!$this->hasRole((string) $value['id'])) {
			//Inicia os parents da role ex:1 e parent da 2 a 2 da 3 etc
			//a 1 herda da 2,3,4 e 5
			$parentNames = null;
			if (!is_null($value['is_admin']) && (int) $value['parent']) {
				$parentNames = (string) $value['parent'];
			}
			//Adiciana a role
			$this->addRole(new Role((string) $value['id']), $parentNames);
		}
		//Se a role for admin conceda totos os privileges
		if ($value['is_admin']) {
			$this->allow((string) $value['id'], array(), array());
		}
	}
	return $this;
}

    /**
	 * Adiciona os resources  e os privileges
	 * @param type $resources
	 * @param type $privileges
	 * @return Acl
	 */
    protected function _addAclRules($resources, $privileges) {

	foreach ($resources as  $resource) {

		if (!$this->hasResource($resource['id'])) {
			$this->addResource(new Resource($resource['id']));
		}
	}


	foreach ($privileges as $privilege) {
		$this->allow((string) $privilege['role'], $privilege['resource'], $privilege['alias']);
	}
	return $this;
}

}
