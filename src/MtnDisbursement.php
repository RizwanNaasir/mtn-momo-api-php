<?php

namespace RizwanNasir\MtnMomo;

use RizwanNasir\MtnMomo\Exceptions\MtnConfigException;
use RizwanNasir\MtnMomo\Exceptions\MtnMomoException;

class MtnDisbursement extends MtnMomo 
{
    const PRODUCT = 'disbursement';


    /**
     * @throws MtnMomoException
     */
    protected function requestUrl(string $endpointName, array $params = []) : string
    {
        $urlSegment = match ($endpointName) {
            'token' => '/disbursement/token/',
            'createTransaction' => '/disbursement/v1_0/transfer',
            'getTransaction' => "/disbursement/v1_0/transfer/{$params['referenceId']}",
            'balance' => '/disbursement/v1_0/account/balance',
            'accountholder' => "/disbursement/v1_0/accountholder/MSISDN/{$params['accountHolderId']}/active",
            default => throw new MtnMomoException("Unknown api endpoint - {$endpointName}."),
        };
 
        return $this->config->baseUrl . $urlSegment;
    }

    /**
     * @throws MtnMomoException
     * @throws MtnConfigException
     */
    public function transfer(array $params, string $transactionUuid = null): string|Http\ApiResponse
    {
        return parent::createTransaction($params, $transactionUuid);
    }
    
}
