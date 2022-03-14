<?php

declare(strict_types=1);

namespace PasswordEntropyBundle;

use PasswordEntropyBundle\Service\NistEntropyCalculator;
use PasswordEntropyBundle\Service\OccurrenceEntropyCalculator;

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

    private NistEntropyCalculator $nistEntropyCalculator;
    private OccurrenceEntropyCalculator $occurrenceEntropyCalculator;

    /**
     * @param NistEntropyCalculator $nistEntropyCalculator
     * @param OccurrenceEntropyCalculator $occurrenceEntropyCalculator
     */
    public function __construct(NistEntropyCalculator $nistEntropyCalculator, OccurrenceEntropyCalculator $occurrenceEntropyCalculator)
    {
        $this->nistEntropyCalculator = $nistEntropyCalculator;
        $this->occurrenceEntropyCalculator = $occurrenceEntropyCalculator;
    }
}