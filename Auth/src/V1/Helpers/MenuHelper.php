<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 11/12/2017
 * Time: 09:12
 */

namespace SIGA\Auth\V1\Helpers;


use SIGA\Auth\V1\Tables\MenuTable;
use SIGA\Core\TablesAbstract;
use Zend\Db\Adapter\AdapterInterface;

class MenuHelper extends TablesAbstract
{

    /**
     * @var \Slim\Container
     */
    private $container;
    private $menus;
    private $schema;
    protected $table = "menus";
    private $submenus;


    /**
     * MenuHelper constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
        $this->adapter = $adapter;
    }

    public function getMenus($tipo) {

        $this->menus = $this->getSelect(['tipo'=>$tipo, 'status' => '1'])->where( new \Zend\Db\Sql\Predicate\IsNull('parent'));
        $this->menus->order(['ordem'=>'ASC']);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->menus);
        $this->exec();
        if ($this->resultSet->count()):
            $Menus = $this->resultSet->toArray();
            if($Menus):
                foreach ($Menus as $key => $menu):
                    $this->submenus = $this->getSelect(['tipo'=>$tipo, 'parent' => $menu['id'], 'status' => '1'])->where( new \Zend\Db\Sql\Predicate\IsNotNull('parent'));
                    $this->submenus->order(['ordem'=>'ASC']);
                    $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->submenus);
                    $this->exec();
                    if ($this->resultSet->count()):
                        $SubMenus = $this->resultSet->toArray();
                        if($SubMenus):
                            $Menus[$key]['pages']= $SubMenus;
                        endif;
                    endif;
                endforeach;
                return $Menus;
            endif;
        endif;
        return [];
    }

    public function active($menu) {

        if (isset($_SESSION['route'])):
            if ($_SESSION['route'] == $menu):
                return 'active';
            endif;
            if (strstr($_SESSION['route'], $menu)):
                return 'active';
            endif;

        endif;
        return "";
    }

    public function getSchema($menu) {
        return sprintf("%s/%s", $this->schema, $menu);
    }


}