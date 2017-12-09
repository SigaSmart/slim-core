<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

/**
 * Description of DriverAbstract
 *
 * @author caltj
 */
abstract class DriverAbstract implements Strategys\StrategyDriver {

    /**
     *
     * @var PDO\Database
     */
    protected $Pdo;

    /**
     * Set o driver
     * @param \PDO $Pdo
     */
    public function __construct(PDO\Database $Pdo){
        $this->Pdo = $Pdo;
    }
}
