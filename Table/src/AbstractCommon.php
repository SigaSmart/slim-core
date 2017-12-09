<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Table;

use SIGA\Core\Views;

/**
 * Description of AbstractCommon
 *
 * @author caltj
 */
abstract class AbstractCommon  {

    /**
     * Table object
     * @var AbstractTable
     */
    protected $table;
    /**
     * @var Views
     */
    protected $View;

    /**
     *
     * @return AbstractTable
     */
    public function getTable() {
        return $this->table;
    }

    /**
     *
     * @param AbstractTable $table
     * @return AbstractCommon
     */
    public function setTable($table) {
        $this->table = $table;
        return $this;
    }
    
    public function setView($View){
        $this->View = $View;
        return $this;
    }

    public function getContainer(){
        return $this->View->getC();
    }

    public function getUrl(){
        return $this->View->getUrl();
    }
}
