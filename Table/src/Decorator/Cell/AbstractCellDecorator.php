<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Cell;

use SIGA\Table\Cell;
use SIGA\Table\Decorator\AbstractDecorator;
use SIGA\Table\Decorator\DataAccessInterface;

abstract class AbstractCellDecorator extends AbstractDecorator implements DataAccessInterface
{

    /**
     * Get cell object
     * @var Cell
     */
    protected $cell;

    /**
     *
     * @return Cell
     */
    public function getCell()
    {
        return $this->cell;
    }

    /**
     *
     * @param Cell $cell
     * @return $this
     */
    public function setCell($cell)
    {
        $this->cell = $cell;
        return $this;
    }


    /**
     * Actual row data
     *
     * @return array
     */
    public function getActualRow()
    {
        return $this->getCell()->getActualRow();
    }
}
