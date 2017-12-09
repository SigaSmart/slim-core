<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Form\Fields;

/**
 * Description of FieldsetAbstract
 *
 * @author caltj
 */
class FieldsetAbstract {

    /**
     * @var array
     */
    private $Data;

    /**
     * @var array
     */
    protected $element;
    protected $type;
    protected $name;
    protected $adapter;
    protected $empresa;
    protected $label;
    protected $attributes = [];
    protected $options = [];

    public function __construct(array $Data) {
        $this->Data = $Data;
        $this->setName($Data['name']);
        if (isset($Data['attributes'])):
            $this->setAttributes($Data['attributes']);
        endif;
        if (isset($Data['options'])):
            $this->setOptions($Data['options']);
            if (isset($Data['options']['label'])):
                $this->setLabel($Data['options']['label']);
            endif;
        endif;
    }

    public function getId() {
        if (isset($this->Data['attributes']['id'])) {
            return $this->Data['attributes']['id'];
        }
        return $this->getName();
    }

    public function getName() {
        return $this->name;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setAttribute($name, $value) {
        $this->setAttributes([$name => $value]);
        return $this;
    }

    public function getAttributes() {
        return array_merge($this->attributes, $this->options);
    }

    public function getAttribute($name) {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : "";
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

    public function setAttributes($attributes) {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    public function setOptions($options) {
        $this->options = $options;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function getValue(){
        return $this->getAttribute('value');
    }

    /**
     * Remove um attribute da tag form
     * @param type $name
     * @return $this
     */
    public function removeAttr($name) {
        if (isset($this->attributes[$name])):
            unset($this->attributes[$name]);
        endif;
        return $this;
    }

    public function dbValueOptions($table, $colunas = ["id", 'name'], $where = " AND status = ?", $values = [1]) {
        if (!empty($where) && $values):
            $values = array_merge([$this->getEmpresa()],$values );
            $statement = $this->adapter->query(sprintf('SELECT %s FROM %s WHERE empresa = ? %s', implode(", ", $colunas), $table, $where), $values);
        else:
            $statement = $this->adapter->query(sprintf('SELECT %s FROM %s WHERE empresa = ?', implode(", ", $colunas), $table), [$this->getEmpresa()]);
        endif;
        $rows = [];
        if ($statement->count()):
            $Datas = $statement->toArray();
            foreach ($Datas as $Data) :
                $rows[reset($Data)] = end($Data);
            endforeach;

        endif;
        $this->options =   array_merge($this->options,['value_options'=>$rows]);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param mixed $adapter
     * @return FieldsetAbstract
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     * @return FieldsetAbstract
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
        return $this;
    }


}
