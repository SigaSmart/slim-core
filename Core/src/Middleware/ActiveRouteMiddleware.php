<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Middleware;

/**
 * Description of ActiveRouteMiddleware
 *
 * @author caltj
 */
class ActiveRouteMiddleware extends \SIGA\Core\MiddlewareAbstract {

	//put your code here
	public function __invoke($request, $response, $next) {
		$route = $request->getAttribute('route');

		// return NotFound for non existent route
		if (empty($route)) {
			throw new \Slim\Exception\NotFoundException($request, $response);
		}
		$_SESSION['route'] = $route->getName();
//            'groups' => $route->getGroups(),
		//            'methods' => $route->getMethods(),
		//            'arguments' => $route->getArguments(),
		return $next($request, $response);
		// do something with that information
	}

}
