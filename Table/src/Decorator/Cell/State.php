<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */


namespace SIGA\Table\Decorator\Cell;

use SIGA\Table\Decorator\Exception;

class State extends AbstractCellDecorator
{

    /**
     * Array of options mapping
     * @var array
     */
    protected $options;


    /**
     * Constructor
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        if (count($options) == 0) {
            throw new Exception\InvalidArgumentException('Array is empty');
        }

        $this->options = $options;
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $class = (isset($this->options['class'][$context])) ? $this->options['class'][$context] : $context;
        $value = (isset($this->options['value'][$context])) ? $this->options['value'][$context] : $context;
        return sprintf('<span  class="text-%s">%s</span>', $class,$value);
    }
}
