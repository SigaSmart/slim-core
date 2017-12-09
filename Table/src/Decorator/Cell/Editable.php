<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Cell;

use SIGA\Table\Decorator\Exception;

class Editable extends AbstractCellDecorator
{

    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($options = array())
    {
    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $cell = $this->getCell();
        $cell->addClass('editable');
        $cell->addAttr('data-column', $cell->getHeader()->getName());
        return $context;
    }
}
