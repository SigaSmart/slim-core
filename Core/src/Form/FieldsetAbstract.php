<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Form;

/**
 * Description of Fieldset
 *
 * @author caltj
 */
class FieldsetAbstract {

	/**
	 * @var array
	 */
	protected $element;
	protected $name;
	protected $legend;
	protected $attributes = [];
	protected $options;

	/**
	 * Attributes globally valid for all tags
	 *
	 * @var array
	 */
	protected $validGlobalAttributes = [
		'accesskey' => true,
		'class' => true,
		'contenteditable' => true,
		'contextmenu' => true,
		'dir' => true,
		'draggable' => true,
		'dropzone' => true,
		'hidden' => true,
		'id' => true,
		'lang' => true,
		'onabort' => true,
		'onblur' => true,
		'oncanplay' => true,
		'oncanplaythrough' => true,
		'onchange' => true,
		'onclick' => true,
		'oncontextmenu' => true,
		'ondblclick' => true,
		'ondrag' => true,
		'ondragend' => true,
		'ondragenter' => true,
		'ondragleave' => true,
		'ondragover' => true,
		'ondragstart' => true,
		'ondrop' => true,
		'ondurationchange' => true,
		'onemptied' => true,
		'onended' => true,
		'onerror' => true,
		'onfocus' => true,
		'oninput' => true,
		'oninvalid' => true,
		'onkeydown' => true,
		'onkeypress' => true,
		'onkeyup' => true,
		'onload' => true,
		'onloadeddata' => true,
		'onloadedmetadata' => true,
		'onloadstart' => true,
		'onmousedown' => true,
		'onmousemove' => true,
		'onmouseout' => true,
		'onmouseover' => true,
		'onmouseup' => true,
		'onmousewheel' => true,
		'onpause' => true,
		'onplay' => true,
		'onplaying' => true,
		'onprogress' => true,
		'onratechange' => true,
		'onreadystatechange' => true,
		'onreset' => true,
		'onscroll' => true,
		'onseeked' => true,
		'onseeking' => true,
		'onselect' => true,
		'onshow' => true,
		'onstalled' => true,
		'onsubmit' => true,
		'onsuspend' => true,
		'ontimeupdate' => true,
		'onvolumechange' => true,
		'onwaiting' => true,
		'role' => true,
		'spellcheck' => true,
		'style' => true,
		'tabindex' => true,
		'title' => true,
		'xml:base' => true,
		'xml:lang' => true,
		'xml:space' => true,
	];

	/**
	 * Standard boolean attributes, with expected values for enabling/disabling
	 *
	 * @var array
	 */
	protected $booleanAttributes = [
		'autofocus' => ['on' => 'autofocus', 'off' => ''],
		'checked' => ['on' => 'checked', 'off' => ''],
		'disabled' => ['on' => 'disabled', 'off' => ''],
		'multiple' => ['on' => 'multiple', 'off' => ''],
		'readonly' => ['on' => 'readonly', 'off' => ''],
		'required' => ['on' => 'required', 'off' => ''],
		'selected' => ['on' => 'selected', 'off' => ''],
	];

	protected function translateHtmlAttributeValue($key, $value) {

		return $value;
	}

	protected function createAttributesString($attributes) {
		$attributes = $this->prepareAttributes($attributes);
		$attributes['id'] = $this->getId($attributes);
		foreach ($attributes as $key => $value) {
			$key = strtolower($key);
			if (!$value && isset($this->booleanAttributes[$key])) {
				// Skip boolean attributes that expect empty string as false value
				if ('' === $this->booleanAttributes[$key]['off']) {
					continue;
				}
			}
			//check if attribute is translatable and translate it
			$value = $this->translateHtmlAttributeValue($key, $value);
			//@TODO Escape event attributes like AbstractHtmlElement view helper does in htmlAttribs ??
			$strings[] = sprintf('%s="%s"', $key, $value);
		}
		return implode(' ', $strings);
	}

	/**
	 * Prepare attributes for rendering
	 *
	 * Ensures appropriate attributes are present (e.g., if "name" is present,
	 * but no "id", sets the latter to the former).
	 *
	 * Removes any invalid attributes
	 *
	 * @param  array $attributes
	 * @return array
	 */
	protected function prepareAttributes(array $attributes) {
		foreach ($attributes as $key => $value) {
			$attribute = strtolower($key);
			if (!isset($this->validGlobalAttributes[$attribute]) && !isset($this->validTagAttributes[$attribute]) && 'data-' != substr($attribute, 0, 5) && 'aria-' != substr($attribute, 0, 5) && 'x-' != substr($attribute, 0, 2)
			) {
				// Invalid attribute for the current tag
				unset($attributes[$key]);
				continue;
			}
			// Normalize attribute key, if needed
			if ($attribute != $key) {
				unset($attributes[$key]);
				$attributes[$attribute] = $value;
			}
			// Normalize boolean attribute values
			if (isset($this->booleanAttributes[$attribute])) {
				$attributes[$attribute] = $this->prepareBooleanAttributeValue($attribute, $value);
			}
		}
		return $attributes;
	}

	/**
	 * Prepare a boolean attribute value
	 *
	 * Prepares the expected representation for the boolean attribute specified.
	 *
	 * @param  string $attribute
	 * @param  mixed $value
	 * @return string
	 */
	protected function prepareBooleanAttributeValue($attribute, $value) {
		if (!is_bool($value) && in_array($value, $this->booleanAttributes[$attribute])) {
			return $value;
		}
		$value = (bool) $value;
		return ($value ? $this->booleanAttributes[$attribute]['on'] : $this->booleanAttributes[$attribute]['off']);
	}

	/**
	 * Get the ID of an element
	 *
	 * If no ID attribute present, attempts to use the name attribute.
	 * If no name attribute is present, either, returns null.
	 *
	 * @return null|string
	 */
	public function getId($element) {
		if (isset($element['id'])) {
			return $element['id'];
		}
		return $element['name'];
	}

	public function getName() {
		return $this->name;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getAttributes() {
		return $this->attributes;
	}

	public function getOptions() {
		return $this->options;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	public function setLabel($label) {
		$this->label = $label;
		return $this;
	}

	public function setAttribute($name, $value) {
		$this->setAttributes([$name => $value]);
		return $this;
	}

	public function setAttributes($attributes) {
		array_merge($this->attributes, $attributes);
		return $this;
	}

}
