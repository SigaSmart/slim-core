<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace SIGA\Core\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;
/**
 * Description of MatchesPasswordException
 *
 * @author caltj
 */
class MatchesPasswordException extends ValidationException{
    
    public static  $defaultTemplates = [
      
        self::MODE_DEFAULT => [
            
            self::STANDARD => 'Password does not match.',
        ]
    ];
}
