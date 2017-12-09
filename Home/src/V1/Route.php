<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Home\V1;

use SIGA\Home\V1\Controllers;
use SIGA\Core\RouteAbstract;

/**
 * Description of Route
 *
 * @author caltj
 */
class Route extends RouteAbstract {

	//put your code here
	public function create() {

		//rotas home protegidas
		 $this->app->get("[/]", sprintf("%s:index", Controllers\HomeController::class))->setName('home');

       
	}

}