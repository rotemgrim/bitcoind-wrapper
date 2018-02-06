<?php

namespace BitcoinWrapper;


class Wallet
{

    private $client;

    /**
     * Wallet constructor.
     * @param BitcoindClient $client
     */
    public function __construct(BitcoindClient $client)
    {
        $this->client = $client;
    }

    public function getAccount()
    {
        return $this->client->send('getaccount');
    }

    public function getAccountAddress($accountName)
    {
        return $this->client->send('getaccountaddress', $accountName);
    }
}