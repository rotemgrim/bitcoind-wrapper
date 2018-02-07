<?php

namespace BitcoinWrapper;


class Block extends AbstractRpc
{
    /**
     * The getBlockChainInfo RPC provides information about the current state of the block chain.
     * @return object - A JSON object providing information about the block chain
     */
    public function getBlockChainInfo()
    {
        return $this->decodeFromJson($this->client->send('getblockchaininfo'));
    }
}