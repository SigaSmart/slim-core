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
 * Description of Register
 *
 * @author caltj
 */
class Register extends ModelAbstract {

	public function __construct($input = array(), $flags = self::STD_PROP_LIST, $iteratorClass = 'ArrayIterator') {
		parent::__construct($input, $flags, $iteratorClass);

	}

	public function getInputFilter() {
		if (!$this->inputFilter):
			$this->inputFilter = new \Zend\InputFilter\InputFilter();
			$this->inputFilter->add([
				'name' => 'first_name',
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
							'max' => 255,
							'min' => 1,
							'messages' => [
								\Zend\Validator\StringLength::TOO_SHORT => "Campo Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo Obrigatorio"],
						],
					],
				],
			]);

			$this->inputFilter->add([
				'name' => 'last_name',
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
							'max' => 255,
							'min' => 1,
							'messages' => [
								\Zend\Validator\StringLength::TOO_SHORT => "Campo Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo Obrigatorio"],
						],
					],
				],
			]);

			$this->inputFilter->add([
				'name' => 'email',
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
						'name' => \Zend\Validator\Db\NoRecordExists::class,
						'options' => [
							'table' => 'users',
							'field' => 'email',
							'adapter' => $this->getAdapter(),
							'messages' => [
								\Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'Email Ja Existe!',
							],
						],
					],
					[
						'name' => \Zend\Validator\StringLength::class,
						'options' => [
							'max' => 255,
							'min' => 10,
							'messages' => [
								\Zend\Validator\StringLength::TOO_SHORT => "Campo Muito Curto",
								\Zend\Validator\StringLength::TOO_LONG => "Campo Muito Longo",
							],
						],
					],
					[
						'name' => \Zend\Validator\EmailAddress::class,
						'options' => [
							'messages' => [
								\Zend\Validator\EmailAddress::INVALID_FORMAT => " E-Mail no formato invalido",
								\Zend\Validator\EmailAddress::INVALID_HOSTNAME => "E-Mail host invalido",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo Obrigatorio"],
						],
					],
				],
			]);

			$this->inputFilter->add([
				'name' => 'password',
				'required' => true,
				'filters' => [
					[
						'name' => \Zend\Filter\StringTrim::class,
					],
				],
				'validators' => [
					[
						'name' => \Zend\Validator\StringLength::class,
						'options' => [
							'max' => 10,
							'min' => 6,
							'messages' => [
								\Zend\Validator\StringLength::TOO_SHORT => "A Semha deve ter no minimo 5 caracteres!",
								\Zend\Validator\StringLength::TOO_LONG => "A Semha deve ter no maximo 10 caracteres!",
							],
						],
					],
					[
						'name' => \Zend\Validator\NotEmpty::class,
						'options' => [
							'messages' => [\Zend\Validator\NotEmpty::IS_EMPTY => "Campo Obrigatorio"],
						],
					],
				],
			]);

		endif;
		return parent::getInputFilter();
	}

}