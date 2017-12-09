<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Params;

use SIGA\Table\AbstractCommon;

abstract class AbstractAdapter extends AbstractCommon
{

    /**
     * Get configuration of table
     *
     * @return \SIGA\Table\Options\ModuleOptions
     */
    public function getOptions()
    {
        return $this->getTable()->getOptions();
    }
}
