<?php

/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Cell;

class Number extends AbstractCellDecorator {

    /**
     * Constructor
     *
     */
    public function __construct() {
        
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context) {
        return number_format($context, 2, ",", '');
    }

}
