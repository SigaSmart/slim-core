<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Models;

use SIGA\Core\ModelAbstract;
use Zend\InputFilter\InputFilter;
/**
 * Description of Menutheme
 *
 * @author caltj
 */
class Menutheme extends ModelAbstract {

    public function __construct($input = array(), $flags = self::STD_PROP_LIST, $iteratorClass = 'ArrayIterator') {
        parent::__construct($input, $flags, $iteratorClass);
       
    }

    public function getInputFilter() {
        if (!$this->inputFilter):
            $this->inputFilter = new InputFilter();
           $this->inputFilter->add([
				'name' => 'name',
				'required' => true,
				'filters' => [
					[
						'name' => \Zend\Filter\StringTrim::class,
						'options' => [
						],
					],
				],
				'validators' => [
					[
						'name' => \Zend\Validator\StringLength::class,
						'options' => [
							'max' => 50,
							'min' => 1,
							'messages' => [
								\Zend\Validator\StringLength::TOO_SHORT => "Campo [Nome do tema] Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo [Nome do tema] Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo [Nome do tema] Obrigatorio"],
						],
					],
				],
			]);

           $this->inputFilter->add([
				'name' => 'alias',
				'required' => true,
				'filters' => [
					[
						'name' => \Zend\Filter\StringTrim::class,
						'options' => [
						],
					],
				],
				'validators' => [
					[
						'name' => \Zend\Validator\StringLength::class,
						'options' => [
							'max' => 50,
							'min' => 1,
							'messages' => [
								\Zend\Validator\StringLength::TOO_SHORT => "Campo [Alias] Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo [Alias] Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo [Alias] Obrigatorio"],
						],
					],
				],
			]);
        endif;
        return parent::getInputFilter();
    }

}