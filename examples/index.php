<?php
namespace BitcoinWrapper;

require "../vendor/autoload.php";

$bc = new BitcoindClient(
    'foo',
    'bar',
    'localhost',
    18333
);

$result = $bc->wallet->getWalletInfo();
print_r($result);

$result2 = $bc->block->getBlockChainInfo();
print_r($result2);