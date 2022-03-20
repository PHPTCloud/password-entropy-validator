<?php

declare(strict_types=1);

namespace Tests\Service;

use PasswordEntropyBundle\Service\OccurrenceEntropyCalculator;
use PHPUnit\Framework\TestCase;

class OccurrenceEntropyCalculatorTest extends TestCase
{
    private OccurrenceEntropyCalculator $occurrenceEntropyCalculator;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->occurrenceEntropyCalculator = new OccurrenceEntropyCalculator();
    }

    /**
     * @return void
     */
    public function checkLevelProvider(): array
    {
        return [
            [1, 'aaa'],
            [2, 'aaas'],
            [2, 'passss'],
            [3, '1233213'],
            [3, 'manonna'],
            [4, 'password'],
            [0, 'asdfghjkl1234567890!@#$%^&'],
        ];
    }

    /**
     * @dataProvider checkLevelProvider
     * 
     * @return void
     */
    public function testCheckLevel(int $level, string $password): void
    {
        $this->assertEquals($level, $this->occurrenceEntropyCalculator->checkLevel($password));
    }
}