<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Helper;


/**
 * Description of ViewsHelper
 *
 * @author caltj
 */
class ViewsHelper {

    protected $Authenticate;
    public function getEmpresa(){
        return $this->Authenticate;
    }

}
