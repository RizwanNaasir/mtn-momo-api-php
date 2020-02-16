<?php

namespace PatricPoba\MtnMomo;

use PatricPoba\MtnMomo\Exceptions\MtnMomoException;

class MtnCollection extends MtnMomo 
{
    const PRODUCT = 'collection';


    protected function getRequestUrl($endpointName, $params = []) : string
    { 
        switch ($endpointName) {
            case 'token':  
                $urlSegment = '/collection/token' ;
                break;

            case 'postTransaction': 
                $urlSegment = '/collection/v1_0/requesttopay';
                break;
                 
            case 'getTransaction': 
                $urlSegment = "/collection/v1_0/requesttopay/{$params['referenceId']}";
                break;
 
            case 'balance': 
                $urlSegment = '/collection/v1_0/account/balance';
                break;
 
            case 'accountholder': 
                $urlSegment = "/collection/v1_0/accountholder/{$params['accountHolderIdType']}/{$params['accountHolderId']}/active";
                break;
            
            default:
                throw new MtnMomoException("Unknown Api endpoint - {$endpointName}.");
                break;
        }
 
        return $this->config->baseUrl . $urlSegment;
    }

}
