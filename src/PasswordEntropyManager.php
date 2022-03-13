<?php

declare(strict_types=1);

namespace PasswordEntropyBundle;

use PasswordEntropyBundle\Service\NistEntropyCalculationService;

/**
 * @author tcloud.ax <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class PasswordEntropyManager
{
    public const FIRST_STRENGHT_LEVEL = 1;
    public const SECOND_STRENGHT_LEVEL = 2;
    public const THIRD_STRENGHT_LEVEL = 3;
    public const FOURTH_STRENGHT_LEVEL = 4;

    private NistEntropyCalculationService $nistEntropyCalculationService;

    /**
     * @param NistEntropyCalculationService $nistEntropyCalculationService
     */
    public function __construct(NistEntropyCalculationService $nistEntropyCalculationService)
    {
        $this->nistEntropyCalculationService = $nistEntropyCalculationService;
    }

    /**
     * Проверит уровень пароля
     * 
     * @param string $password
     * 
     * @return int
     */
    public function check(string $password): int
    {
        return $this->nistEntropyCalculationService->checkLevel($password);
    }
}