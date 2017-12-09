<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */


namespace SIGA\Table\Decorator\Cell;

use SIGA\Table\Decorator\Exception;

class Button extends AbstractCellDecorator
{

    /**
     * Array of variables
     * @var null | array
     */
    protected $vars;
    private $Href = "";


    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['href'])) {
            throw new Exception\InvalidArgumentException('href in options argument requred');
        }
        if (!isset($options['icon'])) {
            throw new Exception\InvalidArgumentException('icon in options argument requred');
        }
        if (!isset($options['class'])) {
            throw new Exception\InvalidArgumentException('href in options argument requred');
        }
        if (!isset($options['id'])) {
            throw new Exception\InvalidArgumentException('id in options argument requred');
        }
        $this->vars = $options;
    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $actualRow = $this->getCell()->getActualRow();
        if(empty($this->Href)):
            $this->Href = $this->vars['href'];
        endif;
        $this->vars['href'] =str_replace("{id}",$actualRow[$this->vars['id']],$this->Href);
        $aFind = explode('&', '{' . implode("}&{", array_keys($this->vars)) . '}');
        $aSub = array_values($this->vars);
        $value = str_replace($aFind, $aSub,'<a href="{href}" class="{class}"><i class="{icon}"></i><span></span></a>');
        return $value;

    }
}
