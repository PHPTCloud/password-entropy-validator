<?php

declare(strict_types=1);

namespace Tests\Service;

use PHPTCloud\PasswordEntropyBundle\Service\NistEntropyCalculator;
use PHPUnit\Framework\TestCase;

class NistEntropyCalculatorTest extends TestCase
{
    private NistEntropyCalculator $nistEntropyCalculator;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->nistEntropyCalculator = new NistEntropyCalculator();
    }

    public function checkLevelProvider(): array
    {
        return [
            [1, 'pass'],
            [2, 'password'],
            [2, 'againpassword'],
            [3, 'third password'],
            [3, 'Th1rdPassword'],
            [4, '`wEw8gE^m9m^zUf.$Fs_FLR9ga'],
            [0, '@_C~MzQS~kt))7U.H!sJP2"vbL]-M:*yFrUQc+>ZD#kEpc@(*s;R-CfBQPR3Q'],
            [0, 'U3R9oOVgfmK9iDDG85wW0vgzr0JrbwKXmIBI4BO2dRIjnvhr8mEI2FfIdx2z58Ue8'],
        ];
    }

    /**
     * @dataProvider checkLevelProvider
     * 
     * @return void
     */
    public function testCheckLevel(int $level, string $password): void
    {
        $this->assertEquals($level, $this->nistEntropyCalculator->checkLevel($password));
    }

    /**
     * @return array
     */
    public function calculateProvider(): array
    {
        return [
            [10.0, 'pass'],
            [18.0, 'password'],
            [25.5, 'againpassword'],
            [33.0, 'third password'],
            [31.5, 'Th1rdPassword'],
            [45.5, '`wEw8gE^m9m^zUf.$Fs_FLR9ga'],
            [80.5, '@_C~MzQS~kt))7U.H!sJP2"vbL]-M:*yFrUQc+>ZD#kEpc@(*s;R-CfBQPR3Q'],
            [84.5, 'U3R9oOVgfmK9iDDG85wW0vgzr0JrbwKXmIBI4BO2dRIjnvhr8mEI2FfIdx2z58Ue8'],
        ];
    }

    /**
     * @dataProvider calculateProvider
     * 
     * @return void
     */
    public function testCalculate(float $bits, string $password): void
    {
        $this->assertEquals($bits, $this->nistEntropyCalculator->calculate($password));
    }
}
