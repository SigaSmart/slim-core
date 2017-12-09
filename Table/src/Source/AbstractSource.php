<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Source;

use SIGA\Table\AbstractCommon;
use SIGA\Table\Source\SourceInterface;

abstract class AbstractSource extends AbstractCommon implements SourceInterface
{

    /**
     *
     * @var \SIGA\Table\Params\AdapterInterface
     */
    protected $paramAdapter;


    abstract protected function order();

    /**
     * @return \SIGA\Table\Params\AdapterInterface
     */
    public function getParamAdapter()
    {
        if (!$this->paramAdapter) {
            $this->paramAdapter = $this->getTable()->getParamAdapter();
        }
        return $this->paramAdapter;
    }

    /**
     *
     * @return \Zend\Paginator\Paginator
     */
    public function getData()
    {
        $paginator = $this->getPaginator();
        return $paginator;
    }


    /**
     * Init query like ordering and quick searching
     */
    protected function initQuery()
    {
        $this->order();
        $this->quickSearch();
    }

    /**
     * Init paginator
     */
    protected function initPaginator()
    {
        $this->paginator->setItemCountPerPage($this->getParamAdapter()->getItemCountPerPage());
        $this->paginator->setCurrentPageNumber($this->getParamAdapter()->getPage());
    }

    /**
     *
     * @param \Zend\Paginator\Paginator $paginator
     */
    public function setPaginator(\Zend\Paginator\Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     *
     * @param \SIGA\Table\Params\AdapterInterface $paramAdapter
     */
    public function setParamAdapter(\SIGA\Table\Params\AdapterInterface $paramAdapter)
    {
        $this->paramAdapter = $paramAdapter;
    }
}
