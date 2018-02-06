<?php

namespace BitcoinWrapper;


use Nbobtc\Command\Command;
use Nbobtc\Http\Client;
use Nbobtc\Http\Message\Response;

class BitcoindClient
{

    /** @var Client */
    private $client;
    private $host;
    private $user;
    private $password;
    private $rpcPort;

    public $wallet;

    const AVAILABLE_COMMANDS = ['abandontransaction', 'addmultisigaddress', 'addnode', 'addwitnessaddress', 'backupwallet', 'bumpfee', 'clearbanned', 'createmultisig', 'createrawtransaction', 'decoderawtransaction', 'decodescript', 'disconnectnode', 'dumpprivkey', 'dumpwallet', 'encryptwallet', 'estimatefee', 'estimatepriority', 'fundrawtransaction', 'generate', 'generatetoaddress', 'getaccountaddress', 'getaccount', 'getaddednodeinfo', 'getaddressesbyaccount', 'getbalance', 'getbestblockhash', 'getblock', 'getblockcount', 'getblockhash', 'getblockheader', 'getblocktemplate', 'getchaintips', 'getconnectioncount', 'getdifficulty', 'getgenerate', 'gethashespersec', 'getinfo', 'getmemoryinfo', 'getmempoolancestors', 'getmempooldescendants', 'getmempoolentry', 'getmempoolinfo', 'getmininginfo', 'getnettotals', 'getnetworkhashps', 'getnetworkinfo', 'getnewaddress', 'getpeerinfo', 'getrawchangeaddress', 'getrawmempool', 'getrawtransaction', 'getreceivedbyaccount', 'getreceivedbyaddress', 'gettransaction', 'gettxout', 'gettxoutproof', 'gettxoutsetinfo', 'getunconfirmedbalance', 'getwalletinfo', 'getwork', 'help', 'importaddress', 'importmulti', 'importprivkey', 'importprunedfunds', 'importwallet', 'keypoolrefill', 'listaccounts', 'listaddressgroupings', 'listbanned', 'listlockunspent', 'listreceivedbyaccount', 'listreceivedbyaddress', 'listsinceblock', 'listtransactions', 'listunspent', 'lockunspent', 'move', 'ping', 'preciousblock', 'prioritisetransaction', 'pruneblockchain', 'removeprunedfunds', 'sendfrom', 'sendmany', 'sendrawtransaction', 'sendtoaddress', 'setaccount', 'setban', 'setgenerate', 'setnetworkactive', 'settxfee', 'signmessage', 'signmessagewithprivkey', 'signrawtransaction', 'stop', 'submitblock', 'validateaddress', 'verifychain', 'verifymessage', 'verifytxoutproof', 'walletlock', 'walletpassphrase', 'walletpassphrasechange'];

    public function __construct($user, $password, $host, $rpcPort)
    {
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
        $this->rpcPort = $rpcPort;

        $this->client  = new Client("http://{$user}:{$password}@{$host}:{$rpcPort}");
        $this->wallet = new Wallet($this);
    }

    /**
     * @param string $commandStr
     * @param array|null $parameters
     * @param string $id
     * @return string
     */
    public function send($commandStr, $parameters = null, $id = null)
    {

        try {
            $commandStr = strtolower($commandStr);
            if ($this->isCommandExist($commandStr)) {

                $command = new Command($commandStr, $parameters, $id);

                /** @var Response */
                $response = $this->client->sendCommand($command);

                if ($response->getStatusCode() !== 200) {
                    throw new \Exception($response->getStatusCode() . ' - ' . $response->getReasonPhrase());
                }

                /** @var string */
                return $response->getBody()->getContents();
            }

            else {
                throw new \Exception('Command ' . $commandStr . ' dose not exits in API');
            }
        }

        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function isCommandExist($command)
    {
        return in_array($command, self::AVAILABLE_COMMANDS);
    }
}
