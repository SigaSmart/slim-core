<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator\Header;

use SIGA\Table\Decorator\AbstractDecorator;

abstract class AbstractHeaderDecorator extends AbstractDecorator
{

    /**
     * Header object
     * @var \SIGA\ZfTable\Header
     */
    protected $header;

    /**
     *
     * @return \SIGA\ZfTable\Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     *
     * @param \SIGA\Table\Header $header
     * @return \SIGA\Table\Decorator\Header\AbstractHeaderDecorator
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }
}
