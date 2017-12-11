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
 * Description of Menu
 *
 * @author caltj
 */
class Menu extends ModelAbstract {

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
								\Zend\Validator\StringLength::TOO_SHORT => "Campo [Nome\Descrição] Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo [Nome\Descrição] Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo [Nome\Descrição] Obrigatorio"],
						],
					],
				],
			]);
           $this->inputFilter->add([
				'name' => 'route',
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
								\Zend\Validator\StringLength::TOO_SHORT => "Campo [Rota] Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo [Rota] Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo [Rota] Obrigatorio"],
						],
					],
				],
			]);

           $this->inputFilter->add([
				'name' => 'role',
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
								\Zend\Validator\StringLength::TOO_SHORT => "Campo [Role] Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo [Role] Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo [Role] Obrigatorio"],
						],
					],
				],
			]);
        endif;
        return parent::getInputFilter();
    }

}