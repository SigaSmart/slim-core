<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Form;

use SIGA\Core\Form\AbstractForm;
use SIGA\Core\Form\FieldsetAbstract;

/**
 * Description of Form
 *
 * @author caltj
 */

/**
 * View helper for rendering Form objects
 */
class Form extends FieldsetAbstract {

    /**
     * Attributes valid for this tag (form)
     *
     * @var array
     */
    protected $validTagAttributes = [
        'accept-charset' => true,
        'action' => true,
        'autocomplete' => true,
        'enctype' => true,
        'method' => true,
        'name' => true,
        'novalidate' => true,
        'target' => true,
    ];

    /**
     * Render a form from the provided $form,
     *
     * @param  FormInterface $form
     * @return string
     */
    public function render(AbstractForm $form) {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof Fields\FieldsetAbstract) {
                $formContent .= $this->getView()->formCollection($element);
            } else {
                $formContent .= $this->getView()->formRow($element);
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }

    /**
     * Generate an opening form tag
     *
     * @param  null|FormInterface $form
     * @return string
     */
    public function openTag(AbstractForm $form = null) {
        $attributes = [];
        if ($form instanceof AbstractForm) {
            $formAttributes = $form->getAttributes();
            if (!array_key_exists('id', $formAttributes) && array_key_exists('name', $formAttributes)) {
                $formAttributes['id'] = $formAttributes['name'];
            }
            
            if (is_array($formAttributes)):
                $attributes = array_merge($attributes, $formAttributes);
            endif;
        }

        if ($attributes) {
            return sprintf('<form %s>', $this->createAttributesString($attributes));
        }

        return '<form>';
    }

    /**
     * Generate a closing form tag
     *
     * @return string
     */
    public function closeTag() {
        return '</form>';
    }

    public function init($form) {
       // return (new \ReflectionClass($form))->newInstance();
    }

}
