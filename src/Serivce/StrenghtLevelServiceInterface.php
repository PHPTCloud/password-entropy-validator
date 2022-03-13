<?php

declare(strict_types=1);

namespace PasswordEntropyBundle\Service;

interface StrenghtLevelServiceInterface
{
    /**
     * @param string $password
     * 
     * @return int
     */
    public function checkLevel(string $password): int;
}