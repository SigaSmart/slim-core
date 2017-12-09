<?php

/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace SIGA\Table;

use SIGA\Table\Options\ModuleOptions;

class Render extends AbstractCommon {

    /**
     * PhpRenderer object
     * @var PhpRenderer
     */
    protected $renderer;

    /**
     *
     * @var ModuleOptions
     */
    protected $options;

    /**
     *
     * @param AbstractTable $table
     */
    public function __construct($table) {
        $this->setTable($table);
        $this->setRenderer($table->View);
    }

    /**
     * Rendering paginator
     *
     * @return string
     */
    public function renderPaginator() {
        $paginator = $this->getTable()->getSource()->getPaginator();
        $pages = get_object_vars($paginator->getPages());
        return $pages;
    }

    /**
     * Rendering json for dataTable
     *
     * @return string
     */
    public function renderDataTableJson() {
        $res = array();
        $render = $this->getTable()->getRow()->renderRows('array');
        $res['sEcho'] = $render;
        $res['iTotalDisplayRecords'] = $this->getTable()->getSource()->getPaginator()->getTotalItemCount();
        $res['aaData'] = $render;

        return json_encode($res);
    }

    public function renderNewDataTableJson() {

        $render = $this->getTable()->getRow()->renderRows('array');

        $res = array(
            'draw' => $render,
            'recordsFiltered' => $this->getTable()->getSource()->getPaginator()->getTotalItemCount(),
            'data' => $render,
        );

        return $res;
    }

    /**
     * Rendering init view for dataTable
     *
     * @return string
     */
    public function renderDataTableAjaxInit() {
        $renderedHeads = $this->renderHead();

        $view['headers'] = $renderedHeads;
        $view['attributes'] = $this->getTable()->getAttributes();

        return $this->renderer->partials('data-table-init', $view);
    }

    public function renderCustom($template) {

        $render = '';
        $tableConfig = $this->getTable()->getOptions();

        if ($tableConfig->getShowColumnFilters()) {
            $render .= $this->renderFilters();
        }

        $render .= $this->renderHead();
        $render = sprintf('<thead>%s</thead>', $render);
        $render .= $this->getTable()->getRow()->renderRows();
        $table = sprintf('<table %s>%s</table>', $this->getTable()->getAttributes(), $render);
        $view['table'] = $table;
        $view['paramsWrap'] = $this->renderParamsWrap();
        $view['valuesState'] = $view['paramsWrap']['valuesState'];
        $view['itemCountPerPage'] = $this->getTable()->getParamAdapter()->getItemCountPerPage();
        $view['quickSearch'] = $this->getTable()->getParamAdapter()->getQuickSearch();
        $view['name'] = $tableConfig->getName();
        $view['paginator'] = $this->renderPaginator();
        $view['paginator']['valuesState'] =$view['valuesState'];
        $view['paginator']['showExportToCSV'] = $tableConfig->getShowExportToCSV();
        $view['paginator']['showItemPerPage'] = $tableConfig->getShowItemPerPage();
        $view['paginator']['showButtonsActions'] = $tableConfig->getShowButtonsActions();
        $view['paginator']['valueButtonsActions'] = $tableConfig->getValueButtonsActions();
        $view['paginator']['itemCountPerPage'] = $view['itemCountPerPage'];
        $view['paginator']['route'] = $this->getTable()->route;
        $view['itemCountPerPageValues'] = $tableConfig->getValuesOfItemPerPage();
        $view['paginator']['itemCountPerPageValues'] = $view['itemCountPerPageValues'];
        $view['showQuickSearch'] = $tableConfig->getShowQuickSearch();
        $view['valuesOfState'] = $tableConfig->getValuesOfState();
        $view['showPagination'] = $tableConfig->getShowPagination();
        $view['showItemPerPage'] = $tableConfig->getShowItemPerPage();
        $view['showExportToCSV'] = $tableConfig->getShowExportToCSV();

        return $this->renderer->partials($template, $view);
    }

    /**
     * Rendering table
     *
     * @return string
     */
    public function renderTableAsHtml() {
        $render = '';
        $tableConfig = $this->getTable()->getOptions();

        if ($tableConfig->getShowColumnFilters()) {
            $render .= $this->renderFilters();
        }

        $render .= $this->renderHead();
        $render = sprintf('<thead>%s</thead>', $render);
        $render .= $this->getTable()->getRow()->renderRows();
        $table = sprintf('<table %s>%s</table>', $this->getTable()->getAttributes(), $render);
        $view['table'] = $table;
        $view['paramsWrap'] = $this->renderParamsWrap();
        $view['valuesState'] = $view['paramsWrap']['valuesState'];
        $view['itemCountPerPage'] = $this->getTable()->getParamAdapter()->getItemCountPerPage();
        $view['quickSearch'] = $this->getTable()->getParamAdapter()->getQuickSearch();
        $view['name'] = $tableConfig->getName();
        $view['paginator'] = $this->renderPaginator();
        $view['paginator']['valuesState'] =$view['valuesState'];
        $view['paginator']['showExportToCSV'] = $tableConfig->getShowExportToCSV();
        $view['paginator']['showButtonsActions'] = $tableConfig->getShowButtonsActions();
        $view['paginator']['valueButtonsActions'] = $tableConfig->getValueButtonsActions();
        $view['paginator']['showItemPerPage'] = $tableConfig->getShowItemPerPage();
        $view['paginator']['itemCountPerPage'] = $view['itemCountPerPage'];
        $view['paginator']['route'] = $this->getTable()->route;
        $view['itemCountPerPageValues'] = $tableConfig->getValuesOfItemPerPage();
        $view['paginator']['itemCountPerPageValues'] = $view['itemCountPerPageValues'];
        $view['showQuickSearch'] = $tableConfig->getShowQuickSearch();
        $view['valuesOfState'] = $tableConfig->getValuesOfState();
        $view['showPagination'] = $tableConfig->getShowPagination();
        $view['showItemPerPage'] = $tableConfig->getShowItemPerPage();
        $view['showExportToCSV'] = $tableConfig->getShowExportToCSV();
        return $this->renderer->partials("container-b3", $view);
    }

    /**
     * Rendering filters
     *
     * @return string
     */
    public function renderFilters() {
        $headers = $this->getTable()->getHeaders();
        $render = '';
        foreach ($headers as $name => $params) {

            if (isset($params['filters'])) {
                $value = $this->getTable()->getParamAdapter()->getValueOfFilter($name);
                $id = 'zff_' . $name;

                if (is_string($params['filters'])) {
                    
                } else {
                    //$element = new \Zend\Form\Element\Select($id);
                    //$element->setValueOptions($params['filters']);
                }
                //$element->setAttribute('class', 'filter form-control');
                // $element->setValue($value);
                //$render .= sprintf('<td>%s</td>', $this->getRenderer()->formRow($element));
            } else {
                $render .= '<td></td>';
            }
        }
        return sprintf('<tr>%s</tr>', $render);
    }

    /**
     * Rendering head
     *
     * @return string
     */
    public function renderHead() {
        $headers = $this->getTable()->getHeaders();
        $render = '';
        foreach ($headers as $name => $title) {
            $render .= $this->getTable()->getHeader($name)->render();
        }
        $render = sprintf('<tr class="zf-title">%s</tr>', $render);
        return $render;
    }

    /**
     * Rendering params wrap to ajax communication
     *
     * @return string
     */
    public function renderParamsWrap() {

        $view['column'] = $this->getTable()->getParamAdapter()->getColumn();
        $view['itemCountPerPage'] = $this->getTable()->getParamAdapter()->getItemCountPerPage();
        $view['valuesState'] = $this->getTable()->getParamAdapter()->getValuesState();
        $view['order'] = $this->getTable()->getParamAdapter()->getOrder();
        $view['page'] = $this->getTable()->getParamAdapter()->getPage();
        $view['quickSearch'] = $this->getTable()->getParamAdapter()->getQuickSearch();
        $view['rowAction'] = $this->getTable()->getOptions()->getRowAction();
        return $view;
    }

    /**
     * Get PHPRenderer
     * @return PhpRenderer
     */
    public function getRenderer() {
        if (!$this->renderer) {
            $this->renderer = $this->table->View;
        }
        return $this->renderer;
    }

    /**
     * Set PhpRenderer
     * @param \SIGA\Core\Views $renderer
     */
    public function setRenderer(\SIGA\Core\Views $renderer) {
        $this->renderer = $renderer;
    }

}
