<?php

/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Cell;

use SIGA\Table\Decorator\Exception;

class Status extends AbstractCellDecorator {

    /**
     * Array of variable attribute for link
     * @var array
     */
    protected $vars;

    /**
     * Link class
     * @var string
     */
    protected $class;

    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = array()) {
        if (!isset($options['class'])) {
            throw new Exception\InvalidArgumentException('Url key in options argument required');
        }

        $this->class = $options['class'];

        if (isset($options['vars'])) {
            $this->vars = is_array($options['vars']) ? $options['vars'] : array($options['vars']);
        }
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context) {
        $values = array();
        if (count($this->vars)) {
            $actualRow = $this->getCell()->getActualRow();
            foreach ($this->vars as $key => $var) {
                $values[] = $actualRow[$key];
            }
        }
        $class = vsprintf($this->class, $values);
        return sprintf('<span  class="text-%s">%s</span>', $this->vars['status'][$values[0]], $context);
    }

}
