<?php

declare(strict_types=1);

namespace PasswordEntropyBundle\Service;

interface StrenghtLevelCalculatorInterface
{
    /**
     * @param string $password
     * 
     * @return int
     */
    public function checkLevel(string $password): int;

    /**
     * @param string $password
     * 
     * @return float
     */
    public function calculate(string $password): float;
}