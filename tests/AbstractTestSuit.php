<?php
/**
 * Created by PhpStorm.
 * User: GrimReaper
 * Date: 2018-01-20
 * Time: 11:52
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\VarDumper\VarDumper;

abstract class AbstractTestSuit extends TestCase
{

    /** @var VarDumper */
    protected $varDumper;

    protected function setUp()
    {
        $this->varDumper = new VarDumper();
    }

    public function d($x)
    {
        $this->varDumper::dump($x);
    }
}

function d($x){
    $varDumper = new VarDumper();
    $varDumper::dump($x);
}