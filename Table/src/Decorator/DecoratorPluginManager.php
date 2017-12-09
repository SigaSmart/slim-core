<?php
/**
 * Table ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table\Decorator;

class DecoratorPluginManager
{

    /**
     * Default set of helpers
     *
     * @var array
     */
    protected $invokableClasses = array(

        'cellattr' => '\SIGA\Table\Decorator\Cell\AttrDecorator',
        'cellvarattr' => '\SIGA\Table\Decorator\Cell\VarAttrDecorator',
        'cellclass' => '\SIGA\Table\Decorator\Cell\ClassDecorator',
        'cellicon' => '\SIGA\Table\Decorator\Cell\Icon',
        'cellmapper' => '\SIGA\Table\Decorator\Cell\Mapper',
        'celllink' => '\SIGA\Table\Decorator\Cell\Link',
        'cellimg' => '\SIGA\Table\Decorator\Cell\Img',
        'cellbutton' => '\SIGA\Table\Decorator\Cell\Button',
        'cellcheck' => '\SIGA\Table\Decorator\Cell\Check',
        'cellstatus' => '\SIGA\Table\Decorator\Cell\Status',
        'cellstate' => '\SIGA\Table\Decorator\Cell\State',
        'cellnumber' => '\SIGA\Table\Decorator\Cell\Number',
        'celltemplate' => '\SIGA\Table\Decorator\Cell\Template',
        'celleditable' => '\SIGA\Table\Decorator\Cell\Editable',
        'cellcallable' => '\SIGA\Table\Decorator\Cell\CallableDecorator',


        'rowclass' => '\SIGA\Table\Decorator\Row\ClassDecorator',
        'rowvarattr' => '\SIGA\Table\Decorator\Row\VarAttr',
        'rowseparatable' => '\SIGA\Table\Decorator\Row\Separatable',
        'headercheck' => '\SIGA\Table\Decorator\Header\Check',
    );

    /**
     * Don't share header by default
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * @param mixed $plugin
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof AbstractDecorator) {
            return;
        }
        throw new \DomainException('Invalid Decorator Implementation');
    }
    
    public function getInvokableClasses($name) {
        return $this->invokableClasses[$name];
    }


}
