<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

use Slim\App;
/**
 * Description of RouteAbstract
 *
 * @author caltj
 */
abstract class RouteAbstract implements Strategy\StrategyRoute {

    /**
     * @var App
     */
    protected $app;

    /**
     * Route constructor.
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = $app;
    }

}
