<?php

namespace RizwanNasir\MtnMomo;

use RizwanNasir\MtnMomo\Exceptions\MtnMomoException;

class MtnCollection extends MtnMomo
{
    const PRODUCT = 'collection';


    /**
     * @throws MtnMomoException
     */
    protected function requestUrl(string $endpointName, array $params = []) : string
    {
        $urlSegment = match ($endpointName) {
            'token' => '/collection/token/',
            'createTransaction' => '/collection/v1_0/requesttopay',
            'getTransaction' => "/collection/v1_0/requesttopay/{$params['referenceId']}",
            'balance' => '/collection/v1_0/account/balance',
            'accountholderActive' => "/collection/v1_0/accountholder/MSISDN/{$params['accountHolderId']}/active",
            default => throw new MtnMomoException("Unknown Api endpoint - {$endpointName}."),
        };
 
        return $this->config->baseUrl . $urlSegment;
    }
 
   
    public function requestToPay(array $data, string $transactionUuid = null)
    {
        return parent::createTransaction($data, $transactionUuid);
    }

}
