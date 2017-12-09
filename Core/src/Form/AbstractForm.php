<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Form;


/**
 * Description of AbstractForm
 *
 * @author caltj
 */
class AbstractForm {

    /**
     * @var array
     */
    protected $options;

    /**
     *
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $adapter;
    protected $inputFilter;
    private $attrs;
    private $elements = [];
    private $element = null;
    private $attributes = [];

    public function __construct($name = "AjaxForm", array $options = []) {

        $this->setAttribute('name', $name);
        $this->options = $options;
        $this->add([
            'name' => 'id',
            'type' => \SIGA\Core\Form\Fields\Hidden::class
        ]);

        $this->add([
            'name' => 'empresa',
            'type' => \SIGA\Core\Form\Fields\Hidden::class
        ]);

        $this->add([
            'type' => \SIGA\Core\Form\Fields\Text::class,
            'name' => 'created_at',
            'options' => [
                'label' => "Criado Em:"
            ],
            'attributes' => [
                'class' => 'form-control',
                'readonly' => TRUE
            ]
        ]);
        $this->add([
            'type' => \SIGA\Core\Form\Fields\Text::class,
            'name' => 'updated_at',
            'options' => [
                'label' => "Alterado Em:"
            ],
            'attributes' => [
                'class' => 'form-control',
                'readonly' => TRUE
            ]
        ]);
    }

    public function add(array $data) {
        $this->attrs = $data;
        $this->validate();
        $type = $data['type'];
        $this->elements[$data['name']] = new $type($data);
        $this->elements[$data['name']]->setAdapter($this->adapter);
        $this->elements[$data['name']]->setEmpresa($this->options['empresa']);
    }

    public function validate() {
        if (!isset($this->attrs['name'])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs['name'])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

    public function getElement() {
        return $this->element;
    }

    public function get($name) {
        $this->element = $this->elements[$name];
        return $this->element;
    }

    public function dbValueOptions($table, $colunas = ["id", 'name'], $where = " AND status = ?", $values = [1]) {
        if (!empty($where) && $values):
            $values = array_merge($values, [$this->options['empresa']]);
            $statement = $this->adapter->query(sprintf('SELECT %s FROM %s WHERE empresa = ? %s', implode(", ", $colunas), $table, $where), $values);
        else:
            $statement = $this->adapter->query(sprintf('SELECT %s FROM %s WHERE empresa = ?', implode(", ", $colunas), $table), [$this->options['empresa']]);
        endif;
        $rows = [];
        if ($statement->count()):
            $Datas = $statement->toArray();
            foreach ($Datas as $Data) :
                $rows[reset($Data)] = end($Data);
            endforeach;

        endif;
        return $rows;
    }

    public function dbValueOptionsGroup($table, $colunas = ["id", 'name'], $where = " AND status = ?", $values = [1]) {
        if (!empty($where) && $values):
            $values = array_merge($values, [$this->options['empresa']]);
            $statement = $this->adapter->query(sprintf('SELECT %s FROM %s WHERE empresa = ? %s', implode(", ", $colunas), $table, $where), $values);
        else:
            $statement = $this->adapter->query(sprintf('SELECT %s FROM %s WHERE empresa = ? %s', implode(", ", $colunas), $table, $where), [$this->options['empresa']]);
        endif;
        $rows = [];
        if ($statement->count()):
            $Datas = $statement->toArray();
            foreach ($Datas as $Data) :
                $rows[reset($Data)] = end($Data);
            endforeach;

        endif;
        return $rows;
    }

    public function setData(array $Data) {
        foreach ($Data as $key => $value) {
            if (isset($this->elements[$key])):
                $this->elements[$key]->setAttributes(['value' => $value]);
            endif;
        }
        return $this;
    }

    public function getData() {
        $Data = [];
        foreach ($this->elements as $key => $value) {
            if (isset($this->elements[$key])):
                $Data[$key] = $value->getAttribute('value');
            endif;
        }
        return $Data;
    }

    public function getAttributes() {
        if ($this->element):
            $this->element->getAttributes();
        endif;
        return array_merge($this->attributes, $this->options);
    }

    public function getAttribute($name) {
        if ($this->element):
            return $this->element->getAttribute($name);
        endif;
        return isset($this->attributes[$name]) ? $this->attributes[$name] : "";
    }

    public function setAttributes(array $Attrs) {
        if ($this->element):
            $this->element->setAttributes($Attrs);
            return $this;
        endif;
        $this->attributes = array_merge($this->attributes, $Attrs);
        return $this;
    }

    public function setAttribute($name, $value) {
        if ($this->element):
            $this->element->setAttributes([$name => $value]);
            return $this;
        endif;
        return $this->setAttributes([$name => $value]);
    }

    /**
     * Remove um attribute da tag form ou do input
     * @param type $name
     * @return $this
     */
    public function removeAttr($name) {
        if ($this->element):
            $this->element->removeAttr($name);
            return $this;
        endif;
        unset($this->attributes[$name]);
        return $this;
    }

    public function setFilter() {
        $this->inputFilter = new v;
    }

    public function getAdapter() {
        return $this->adapter;
    }

    public function setAdapter($adapter) {
        $this->adapter = $adapter;
        return $this;
    }

}
