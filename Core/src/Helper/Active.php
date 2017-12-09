<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Helper;

/**
 * Description of Active
 *
 * @author caltj
 */
class Active {

    //put your code here
    public function __construct($request) {
        $route = $request->getAttribute('route');

        // return NotFound for non existent route
     

      
        var_dump($route);
        // do something with that information
    }

}
