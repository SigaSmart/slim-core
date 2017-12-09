<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Helper;

/**
 * Description of FormHelper
 *
 * @author caltj
 */
class FormHelper {

    /**
     * @var array
     */
    protected $element;
    protected $name;
    protected $label;
    protected $attributes = [];
    protected $options;

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

    public function createAttributesString($attributes) {
        unset($attributes['options']);
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
            if (!is_array($value)):
                $strings[] = sprintf('%s="%s"', $key, $value);
            endif;
        }
        return implode(' ', $strings);
    }

    public function getValuesOptions($attributes) {
        $strings=[];
        unset($attributes['options']);
        if (isset($attributes['value_options'])):
            foreach ($attributes['value_options'] as $key => $value) {
                //check if attribute is translatable and translate it
                $value = $this->translateHtmlAttributeValue($key, $value);
                //@TODO Escape event attributes like AbstractHtmlElement view helper does in htmlAttribs ??
                if (!is_array($value)):
                    if ($key == $attributes['value']):
                        $strings[] = sprintf('<option selected value="%s">%s</option>', $key, $value);
                    else:
                        $strings[] = sprintf('<option value="%s">%s</option>', $key, $value);
                    endif;
                else:
                    $optgroup = [];
                    foreach ($value as $grpKey => $group):
                        if ($grpKey == $attributes['value']):
                            $optgroup[] = sprintf('<option selected value="%s">%s</option>', $grpKey, $group);
                        else:
                            $optgroup[] = sprintf('<option value="%s">%s</option>', $grpKey, $group);
                        endif;
                    endforeach;
                    $strings[] = sprintf('<optgroup label="%s">%s</optgroup>', $key, implode('', $optgroup));
                endif;
            }
        endif;

        return implode(' ', $strings);
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

    public function getId($element) {
        if (isset($element['id'])) {
            return $element['id'];
        }
        return $element['name'];
    }

}
