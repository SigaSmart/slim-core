<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Condition;

interface ConditionInterface
{

    /**
     * Check if the condition is valid
     *
     * @return boolean
     */
    public function isValid();
}
