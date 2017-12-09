<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

use Zend\Db\Sql\Predicate\Operator;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;

/**
 * Description of TablesAbstract
 *
 * @author caltj
 */
abstract class TablesAbstract extends Utils {

    /**
     * @var \Zend\Db\Adapter\AdapterInterface
     */
    protected $adapter;
    protected $Sql;

    /**
     *
     * @var \Zend\Db\Adapter\Driver\StatementInterface
     */
    protected $Stmt;
    protected $table;

    /**
     *
     * @var \Zend\Db\ResultSet\ResultSet
     */
    protected $resultSet;

    /**
     *
     * @var \Zend\Db\Sql\Select
     */
    protected $Select;
    protected $id = "id";
    protected $where;
    protected $Result = [
        'result' => FALSE,
        'type' => "danger",
        'msg' => ""
    ];

    /**
     *
     * @var ModelAbstract
     */
    protected $model;

    public function __construct(AdapterInterface $adapter) {
        $this->Sql = new Sql($adapter);
        $this->adapter = $adapter;
    }

    public function getSelect($where = [], $table = null, $colluns = ['*'],  $join = []) {
        $this->Select = $this->Sql->select();
        if ($table):
            $this->table = $table;
        endif;
        if ($join):
            $this->Select->join($join['table'], // join table with alias
                $join['where']  // join expression
            );
        endif;
        $this->filtro($where);
        $this->Select->from($this->table)->columns($colluns);
        $this->Select->where($this->where);
        $this->Select->limit(1000);
        //d($this->Select->getSqlString());
        return $this->Select;
    }

    public function select($where = [], $table = null, $colluns = ['*'], $join = []) {
        $this->Select = $this->Sql->select();
        if ($table):
            $this->table = $table;
        endif;
        if ($join):
            $this->Select->join($join['table'], // join table with alias
                $join['where']  // join expression
            );
        endif;
        $this->filtro($where);
        $this->Select->from($this->table)->columns($colluns);
        $this->Select->where($this->where);
        $this->Select->limit(1000);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->Select);
        $this->exec();
        if ($this->resultSet->count()):
            return $this->resultSet->toArray();
        endif;
        return [];
    }

    public function all() {
        $this->Select = $this->Sql->select()->from($this->table);
        $this->Select->limit(1000);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->Select);
        $this->exec();
        if ($this->resultSet->count()):
            return $this->resultSet->toArray();
        endif;
        return [];
    }

    public function find(int $id, $colluns = ['*'], $join = []) {
        $this->Select = $this->Sql->select();
        $this->Select->from(['a' => $this->table]);
        if ($join):
            $this->Select->join($join['table'], // join table with alias
                $join['where']  // join expression
            );
        endif;
        $this->Select->columns($colluns);
        $this->Select->where(["a.{$this->id}" => $id]);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->Select);
        $this->exec();
        if ($this->resultSet->count()):
            return $this->resultSet->current()->getArrayCopy();
        endif;
        return [];
    }

    public function findBy(array $where, $colluns = ['*'], $table = null) {
        $this->Select = $this->Sql->select();
        if ($table):
            $this->table = $table;
        endif;
        $this->Select->from($this->table);
        $this->Select->columns($colluns);
        $this->Select->where($where);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->Select);
        $this->exec();
        if ($this->resultSet->count()):
            return $this->resultSet->toArray();
        endif;
        return [];
    }

    public function findOneBy(array $where, $colluns = ['*']) {
        $this->filtro($where);
        $this->Select = $this->Sql->select();
        $this->Select->from($this->table);
        $this->Select->columns($colluns);
        $this->Select->where($this->where);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->Select);
        $this->exec();
        if ($this->resultSet->count()):
            return $this->resultSet->current()->getArrayCopy();
        endif;
        return [];
    }

    protected function filtro($condicao) {
        $this->where = new \Zend\Db\Sql\Where();
        if (isset($condicao['user'])) {
            $this->where->addPredicate(new Operator("{$this->table}.user", "=", $condicao['user']));
            unset($condicao['user']);
        }
        if ($this->Model instanceof ModelAbstract) {

            if ($this->Model->offsetExists("empresa")) {
                if (is_array( $this->Model->offsetGet("empresa"))) {
                    $this->where->in("{$this->table}.empresa",  $this->Model->offsetGet("empresa"));
                }
                else{
                    if($this->table == "empresa"):
                      $this->where->addPredicate(new Operator("{$this->table}.id", "=", $this->Model->offsetGet("empresa")));
                    else:
                        $this->where->addPredicate(new Operator("{$this->table}.empresa", "=", $this->Model->offsetGet("empresa")));
                    endif;
                }
            }
        }

        if (isset($condicao['status']) && $condicao['status'] >= 0) {
            // $operator=$condicao['state']>=0?"=":">";
            $this->where->addPredicate(new Operator("{$this->table}.status", "=", $condicao['status']));
            unset($condicao['status']);
        }
        if (isset($condicao['valuesState']) && $condicao['valuesState'] > 0) {
            // $operator=$condicao['state']>=0?"=":">";
            $this->where->addPredicate(new Operator("{$this->table}.status", "=", $condicao['valuesState']));
            unset($condicao['valuesState']);
        }
        if (isset($condicao['zfTableQuickSearch']) && !empty($condicao['zfTableQuickSearch'])) {
            $colls = implode(", ", array_keys($this->tableModel->getHeaders()));
            $this->where->expression("CONCAT_WS(' ', {$colls}) LIKE ?", "%{$condicao['zfTableQuickSearch']}%");
            unset($condicao['zfTableQuickSearch']);
        }
        if ($condicao):
            unset($condicao['table_search'], $condicao['zfTablePage'], $condicao['zfTableColumn'], $condicao['zfTableOrder'], $condicao['zfTableQuickSearch'], $condicao['zfTableItemPerPage'], $condicao['valuesState'], $condicao['id']);
            foreach ($condicao as $key => $value):
                if (isset($value['index']) && isset($value['op']) && isset($value['value'])):
                    $this->where->addPredicate(new Operator("{$this->table}.{$value['index']}", $value['op'], $value['value']));
                else:
                    $this->where->addPredicate(new Operator("{$this->table}.{$key}", "=", $value));
                endif;
            endforeach;
        endif;
        return $this->where;
    }

    //INSERT

    public function insert(ModelAbstract $mode) {
        $Data = $this->clear($mode->getArrayCopy());
        $Query = $this->Sql->insert()
            ->into($this->table)
            ->columns(array_keys($Data))
            ->values($Data);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($Query);
        try {
            $result = $this->Stmt->execute();
            $this->Result['type'] = self::SUCCESS;
            $this->Result['result'] = $result->getGeneratedValue();
            $this->Result['msg'] = "Registro Cadastrado Com Sucesso!";
        } catch (\Exception $e) {
            $this->Result['type'] = self::DANGER;
            $this->Result['result'] = FALSE;
            $this->Result['msg'] = sprintf("OPSS! %s<br />%s!", $e->getMessage(), $e->getPrevious());
        }
        return $this->Result;
    }

    public function save(ModelAbstract $mode) {
        $Data = $this->clear($mode->getArrayCopy());
        if (isset($Data[$this->id])):
            $Query = $this->Sql->update()
                ->table($this->table)
                ->set($Data)
                ->where([$this->id => $Data[$this->id]]);
            $this->Stmt = $this->Sql->prepareStatementForSqlObject($Query);
            try {
                $result = $this->Stmt->execute();
                $this->Result['result'] = $Data[$this->id];
                $this->Result['msg'] = "Registro Atualizado Com Sucesso!";
                $this->Result['type'] = self::SUCCESS;
            } catch (\Exception $e) {
                $this->Result['type'] = self::DANGER;
                $this->Result['result'] = FALSE;
                $this->Result['msg'] = sprintf("OPSS! %s<br />%s!", $e->getMessage(), $e->getPrevious());
            }
        else:
            $Query = $this->Sql->insert()
                ->into($this->table)
                ->columns(array_keys($Data))
                ->values($Data);
            $this->Stmt = $this->Sql->prepareStatementForSqlObject($Query);
            try {
                $result = $this->Stmt->execute();
                $this->Result['type'] = self::SUCCESS;
                $this->Result['result'] = $result->getGeneratedValue();
                $this->Result['msg'] = "Registro Cadastrado Com Sucesso!";
            } catch (\Exception $e) {
                $this->Result['type'] = self::DANGER;
                $this->Result['result'] = FALSE;
                $this->Result['msg'] = sprintf("OPSS! %s<br />%s!", $e->getMessage(), $e->getPrevious());
            }
        endif;
        return $this->Result;
    }

    public function state(array $values, array $where) {
        $Data = $this->clear($values);
        $Query = $this->Sql->update()
            ->table($this->table)
            ->set($Data)
            ->where([$this->id => $where]);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($Query);
        try {
            $this->Stmt->execute();
            $this->Result['result'] = TRUE;
            $this->Result['msg'] = "Registro Atualizado Com Sucesso!";
            $this->Result['type'] = self::SUCCESS;
        } catch (\Exception $e) {
            $this->Result['type'] = self::DANGER;
            $this->Result['result'] = FALSE;
            $this->Result['msg'] = sprintf("OPSS! %s<br />%s!", $e->getMessage(), $e->getPrevious());
        }
        return $this->Result;
    }

    //DELETE

    public function delete(array $where) {
        $Query = $this->Sql->delete()
            ->from($this->table)
            ->where([$this->id => $where]);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($Query);
        try {
            $this->Stmt->execute();
            $this->Result['result'] = TRUE;
            $this->Result['msg'] = "Registro(s) Excluidos com sucesso!";
            $this->Result['type'] = self::SUCCESS;
        } catch (\Exception $e) {
            $this->Result['type'] = self::DANGER;
            $this->Result['result'] = FALSE;
            $this->Result['msg'] = sprintf("OPSS! %s<br />%s!", $e->getMessage(), $e->getPrevious());
        }
        return $this->Result;
    }

    protected function exec() {
        $this->resultSet = new \Zend\Db\ResultSet\ResultSet();
        $this->resultSet->initialize($this->Stmt->execute());
        return $this;
    }

    public function getAdapter(): \Zend\Db\Adapter\AdapterInterface {
        return $this->adapter;
    }

}
