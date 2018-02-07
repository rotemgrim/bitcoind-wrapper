<?php

namespace BitcoinWrapper;


abstract class AbstractRpc
{
    protected $client;

    /**
     * Wallet constructor.
     * @param BitcoindClient $client
     */
    public function __construct(BitcoindClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $string
     * @return object
     */
    protected function decodeFromJson($string)
    {
        return json_decode($string);
    }
}