<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Cell;

class Check extends AbstractCellDecorator
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
    public function render($context)
    {
       return sprintf('<input name="id[%s]" type="checkbox" class="check_acao check icheck" id="%s" value="%s">', $context, $context, $context);
    }
}
