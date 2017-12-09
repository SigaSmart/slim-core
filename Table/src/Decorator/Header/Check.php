<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Header;

class Check extends AbstractHeaderDecorator
{

     /**
     * Constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context="check-all")
    {
       return sprintf('<input style="margin-left: 10px;" type="checkbox" class="pull-left icheck" id="%s">', $context);
    }
}
