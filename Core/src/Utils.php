<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

/**
 * Description of Utils
 *
 * @author caltj
 */
class Utils {

    const SUCCESS = 'success';
    const DANGER = 'danger';
    const INFO = 'info';

    protected $tableModel;
    protected $Model;

    public function setTableModel($tableModel) {
        $this->tableModel = $tableModel;
        return $this;
    }
    
     public function setModel($Model) {
        $this->Model = $Model;
        return $this;
    }

        protected function slugify($string) {
        $slug = trim($string); // trim the string
        $slug = preg_replace('/[^a-zA-Z0-9 -]/', '', $slug); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug = str_replace(' ', '-', $slug); // replace spaces by dashes
        $slug = strtolower($slug);  // make it lowercase
        return $slug;
    }

    public function slugExists(string $SlugName, string $SlugValue, $SlugId = "") {
        $slug = $this->slugify($SlugValue);
        $this->Select = $this->Sql->select();
        $this->Select->from($this->table)
                ->columns([$this->id => $this->id, 'count' => new \Zend\Db\Sql\Expression('COUNT(*)')]);
        $this->Select->where([$SlugName => (string) $slug]);
        $this->Stmt = $this->Sql->prepareStatementForSqlObject($this->Select);
        $result = $this->Stmt->execute()->current();
        if (empty($SlugId)):
            if ($result['count']):
                $slug = sprintf("%s-%s", $slug, $result[$this->id]);
            endif;
        else:
            if ($result['count'] && $SlugId != $result[$this->id]):
                $slug = sprintf("%s-%s", $slug, $SlugId);
            endif;
        endif;
        return $slug;
    }

    public function form_read($post) {
        //$res=str_replace ( ",", "", $post );
        return number_format($post, 2, ",", ".");
    }

    public function form_w($post) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $post); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    public function Calcular($v1, $v2, $op) {
        $v1 = str_replace(".", "", $v1);
        $v1 = str_replace(",", ".", $v1);
        $v2 = str_replace(".", "", $v2);
        $v2 = str_replace(",", ".", $v2);
        switch ($op) {
            case "+":
                $r = $v1 + $v2;
                break;
            case "-":
                $r = $v1 - $v2;
                break;
            case "*":
                $r = $v1 * $v2;
                break;
            case "%":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $v1 + $j;
                break;
            case "/":
                $r = $v1 / $v2;
                break;
            case "tj":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $j;
                break;
            default :
                $r = $v1;
                break;
        }
        $ret = number_format($r, 2, ",", ".");
        return $ret;
    }

    public function margem_lucro($post) {
        $c = $this->Calcular(['capital' => $post['custo'], 'calculo' => "100", 'operacao' => "/"]); // valor($v1, 100, "/");
        $df = $this->Calcular(['capital' => $post['venda'], 'calculo' => $post['custo'], 'operacao' => "-"]); //valor($v2, $v1, "-");
        return $this->Calcular(['capital' => $df, 'calculo' => $c, 'operacao' => "/"]); ///($df, $c, "/");
    }
    
    public function clear($Data){
        if(is_array($Data)):
            return array_filter($Data);
        endif;
        return $Data;
    }

     /**
     * <b>Tranforma TimeStamp:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param STRING $Name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return STRING = $Data = Data no formato timestamp!
     */
    public function Data($Data) {
        $Format = str_replace("-","/", $Data);
        $Format = explode(' ', $Format);
        $Data = explode('/', $Format[0]);

        if(!isset($Data[1])):
            return $Data;
        endif;
        if (!checkdate($Data[1], $Data[0], $Data[2])):
            return false;
        else:
            if (empty($Format[1])):
                $Format[1] = date('H:i:s');
            endif;

            $Data = $Data[2] . '-' . $Data[1] . '-' .$Data[0] . ' ' .$Format[1];
            return $Data;
        endif;
    }

}
