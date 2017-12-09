<?php

/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Condition;


class ConditionPluginManager {

    /**
     * Default set of helpers
     *
     * @var array
     */
    protected $invokableClasses = array(
        'equal' => '\SIGA\Table\Decorator\Condition\Plugin\Equal',
        'notequal' => '\SIGA\Table\Decorator\Condition\Plugin\NotEqual',
        'between' => '\SIGA\Table\Decorator\Condition\Plugin\Between',
        'greaterthan' => '\SIGA\Table\Decorator\Condition\Plugin\GreaterThan',
        'lesserthan' => '\SIGA\Table\Decorator\Condition\Plugin\LesserThan',
    );

    /**
     * Don't share plugin by default
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * See AbstractPluginManager
     *
     * @throws \DomainException
     * @param mixed $plugin
     */
    public function validatePlugin($plugin) {
        if ($plugin instanceof AbstractCondition) {
            return;
        }
        throw new \DomainException('Invalid Condition Implementation');
    }

    public function getInvokableClasses($name) {
        return $this->invokableClasses[$name];
    }

}
