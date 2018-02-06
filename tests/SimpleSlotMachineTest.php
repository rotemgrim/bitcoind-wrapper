<?php


namespace Tests;


use SlotMachine\ClassicSlotMachine;
use SlotMachine\SlotMachineInterface;

class ClassicSlotMachineTest extends AbstractTestSuit
{
    public function testInit()
    {
        $slot = new ClassicSlotMachine(3, [
           'a' => 600,
           'b' => 200,
           'c' => 100,
           'd' => 50,
           'e' => 20,
           'f' => 20,
           'g' => 10,
           'h' => 5
        ]);
        d($this->simulateSpinsStatistics($slot, 10000000, 1));
        $this->simulateSpins($slot, 5);
        $this->assertEquals(true, true);
    }

    private function simulateSpinsStatistics(ClassicSlotMachine $slot, $numberOfSpins, $numberOfCoins)
    {
        $wins = 0;
        $payout = 0;
        $winSymbols = [];
        for ($i = 0; $i < $numberOfSpins; $i++) {
            $tmpResult = $slot->getSpinResults($numberOfCoins)->toArray();
            if ($tmpResult['won']) {
                $wins++;
                $payout += $tmpResult['payout'];
                if (isset($winSymbols[$tmpResult['symbol']])) {
                    $winSymbols[$tmpResult['symbol']]++;
                } else {
                    $winSymbols[$tmpResult['symbol']] = 1;
                }
            }
        }
        ksort($winSymbols);
        return [
            'rounds' => $numberOfSpins,
            'wins' => $wins,
            'win percent' => round($wins / $numberOfSpins * 100, 2) . "%",
            'payout' => $payout,
            'payout percent' => round($payout/$numberOfSpins*$numberOfCoins * 100, 2) . "%",
            'wining symbols' => $winSymbols
        ];
    }

    private function simulateSpins($slot, $numberOfSpins)
    {
        for ($i = 0; $i < $numberOfSpins; $i++) {
            $res = $slot->getSpinResults()->toArray();
            $brief = $res['won'] ? 'win':'lost';
            $brief .= " | " . round($res['symbolPercent']*100, 2)."%";
            echo join(' - ', $res['result']) . " | " . $brief."\n";
        }
    }
}