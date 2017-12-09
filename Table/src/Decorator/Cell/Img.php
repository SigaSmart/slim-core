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
        $values[] = $this->base;
        foreach ($this->vars as $var) {
            $actualRow = $this->getCell()->getActualRow();
            if (is_object($actualRow)) {
                $actualRow = $actualRow->getArrayCopy();
            }
            $values[] = $actualRow[$var];
        }

        $value = vsprintf('<img class="img-md" src="%s%s">', $values);

            return $value;

    }
}
