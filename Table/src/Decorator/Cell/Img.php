<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */


namespace SIGA\Table\Decorator\Cell;

use SIGA\Table\Decorator\Exception;

class Img extends AbstractCellDecorator
{

      /**
     * Array of variables
     * @var null | array
     */
    protected $vars;
    protected $base;
    protected $class;

    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['base'])) {
            throw new Exception\InvalidArgumentException('path key in options argument requred');
        }
        $this->base = $options['base'];
        $this->vars = is_array($options['vars']) ? $options['vars'] : array($options['vars']);
        $this->class = isset($options['class']) ? $options['class'] : 'img-md';
    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $values = array();
		$values[] = $this->class;
		$values[] = $this->base;
		$values[] = $this->base;
		unset($this->vars['class']);
        foreach ($this->vars as $var) {
            $actualRow = $this->getCell()->getActualRow();
            if (is_object($actualRow)) {
                $actualRow = $actualRow->getArrayCopy();
            }
            $values[] = $actualRow[$var];
        }
        $value = vsprintf('<img class="%s" src="%stim-slim.php?src=%s%s&w=100&h=100">', $values);
        return $value;

    }
}
