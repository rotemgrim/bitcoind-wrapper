<?php
namespace BitcoinWrapper;
use Symfony\Component\VarDumper\VarDumper;

require "../vendor/autoload.php";

$bc = new BitcoindClient(
    'foo',
    'bar',
    'localhost',
    18333
);

$result = $bc->wallet->getAccountAddress("");
VarDumper::dump(json_decode($result));