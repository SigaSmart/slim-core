<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/12/2017
 * Time: 08:25
 */

namespace SIGA\Core;


use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;

class Migrations
{

    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * Migrations constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function execute($ddl){

// Existence of $adapter is assumed.
        $sql = new Sql($this->getAdapter());

        $this->getAdapter()->query(
            $sql->buildSqlString($ddl),
            $this->getAdapter()::QUERY_MODE_EXECUTE
        );
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->adapter;
    }



    /**
     * @param $name
     */
    public function _get($name){

        return $this->container->get($name);

    }
}