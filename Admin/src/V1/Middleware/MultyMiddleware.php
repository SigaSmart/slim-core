<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Auth\V1\Middleware;

use SIGA\Core\MiddlewareAbstract;
/**
 * Description of MultyMiddleware
 *
 * @author caltj
 */
class MultyMiddleware extends MiddlewareAbstract {

    //put your code here
    public function __invoke($request, $response, $next) {
        if (!$this->container->auth->check()):

            $this->container->flash->addMessage('error', "Please sign in defore doing that.");
            return $response->withRedirect($this->container->router->pathFor('login'));

        endif;
        return $next($request, $response);
    }

}
