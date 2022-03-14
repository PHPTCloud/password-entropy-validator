<?php

declare(strict_types=1);

namespace PasswordEntropyBundle\Service;

use PasswordEntropyBundle\Exception\PasswordIsEmptyException;
use PasswordEntropyBundle\PasswordEntropyManager;

/**
 * @author tcloud.ax <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class OccurrenceEntropyCalculator implements StrenghtLevelCalculatorInterface
{
    public const FIRST_STRENGHT_LEVEL = 80;  // встречается > 80%     очень слабый пароль
    public const SECOND_STRENGHT_LEVEL = 50; // встречается > 50-79%  слабый пароль
    public const THIRD_STRENGHT_LEVEL = 35;  // встречается > 35-49%  приемлемый уровень вхождения
    public const FOURTH_STRENGHT_LEVEL = 10; // встречается > 10-34%  сильный пароль
                                             // встречается < 9%      очень сильный пароль

    private ?string $char; // символ с большой степенью вхождения в пароле

    /**
     * @return string|null
     */
    public function getChar(): ?string
    {
        return $this->char;
    }
    
    /**
     * @param string $password
     * 
     * @return float
     * 
     * @throws PasswordIsEmptyException
     */
    public function calculate(string $password): float
    {
        if (empty($password)) {
            throw new PasswordIsEmptyException('Entropy can\'t be calculate because password is empty!');
        }
        $passwordLength  = strlen($password);
        $occurrenceCount = 0;
        $chars           = mb_str_split($password);
        foreach ($chars as $char) {
            $count = substr_count($password, $char);
            if ($count > $occurrenceCount) {
                $occurrenceCount = $count;
                $this->char      = $char;
            }
        }

        return round(($occurrenceCount / $passwordLength) * 100, 5);
    }

    /**
     * @inheritDoc
     */
    public function checkLevel(string $password): int
    {
        $percents = $this->calculate($password);
        if ($percents >= self::FIRST_STRENGHT_LEVEL) {
            return PasswordEntropyManager::FIRST_STRENGHT_LEVEL;
        } elseif (
            $percents < self::FIRST_STRENGHT_LEVEL 
            && $percents >= self::SECOND_STRENGHT_LEVEL
        ) {
            return PasswordEntropyManager::SECOND_STRENGHT_LEVEL;
        } elseif (
            $percents < self::SECOND_STRENGHT_LEVEL 
            && $percents >= self::THIRD_STRENGHT_LEVEL
        ) {
            return PasswordEntropyManager::THIRD_STRENGHT_LEVEL;
        } elseif (
            $percents < self::THIRD_STRENGHT_LEVEL 
            && $percents >= self::FOURTH_STRENGHT_LEVEL
        ) {
            return PasswordEntropyManager::FOURTH_STRENGHT_LEVEL;
        }

        return 0;
    }
}