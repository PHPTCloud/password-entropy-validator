<?php

declare(strict_types=1);

namespace PHPTCloud\PasswordEntropyBundle\Service;

use PHPTCloud\PasswordEntropyBundle\Exception\PasswordIsEmptyException;
use PHPTCloud\PasswordEntropyBundle\Interfaces\PasswordEntropyLevelInterface;

/**
 * @link   https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-63ver1.0.2.pdf
 *         "Special Publication 800-63" A.2.1 Guessing Entropy Estimate
 *         Authors: William E. Burr, Donna F. Dodson, Elaine M. Newton, Ray A. Perlner, W. Timothy Polk, Sarbari Gupta, Emad A. Nabbus
 * @author tcloud.ax <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class NistEntropyCalculator implements StrenghtLevelCalculatorInterface
{
    private const FIRST_LEVEL_BIT = 4.0;
    private const SECOND_LEVEL_BIT = 2.0;
    private const THIRD_LEVEL_BIT = 1.5;
    private const FOURTH_LEVEL_BIT = 1.0;
    private const OUT_ALPHABET_LEVEL_BIT = 6; // бонусные 6 бит, если в пароле есть заглавные или спец. символы
    public const FIRST_STRENGHT_LEVEL = 16;   // bits < 16      очень слабый пароль
    public const SECOND_STRENGHT_LEVEL = 27;  // bits < 17-27   слабый пароль
    public const THIRD_STRENGHT_LEVEL = 44;   // bits < 28-44   средний пароль
    public const FOURTH_STRENGHT_LEVEL = 80;  // bits < 45-80   сильный пароль
                                              // bits > 80      очень сильный пароль

    /**
     * @inheritDoc
     */
    public function checkLevel(string $password): int
    {
        $bits = $this->calculate($password);
        if ($bits <= self::FIRST_STRENGHT_LEVEL) {
            return PasswordEntropyLevelInterface::FIRST_STRENGHT_LEVEL;
        } elseif ($bits <= self::SECOND_STRENGHT_LEVEL) {
            return PasswordEntropyLevelInterface::SECOND_STRENGHT_LEVEL;
        } elseif ($bits <= self::THIRD_STRENGHT_LEVEL) {
            return PasswordEntropyLevelInterface::THIRD_STRENGHT_LEVEL;
        } elseif ($bits <= self::FOURTH_STRENGHT_LEVEL) {
            return PasswordEntropyLevelInterface::FOURTH_STRENGHT_LEVEL;
        }

        return 0;
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
        $bits           = 0;
        $passwordLength = strlen($password);
        $bits += self::FIRST_LEVEL_BIT;
        if ($passwordLength > 1) {
            $bits += $this->calculateLevel($password, self::SECOND_LEVEL_BIT, 1, 7);
        }
        if ($passwordLength > 8) {
            $bits += $this->calculateLevel($password, self::THIRD_LEVEL_BIT, 8, 11);
        }
        if ($passwordLength > 20) {
            $bits += $this->calculateLevel($password, self::FOURTH_LEVEL_BIT, 21, -1);
            // mb_strimwidth с $end = -1 не возьмет последний символ, поэтому
            // прибавляем бит самостоятельно. 
            $bits += self::FOURTH_LEVEL_BIT;
        }
        if ($this->hasNonAlphabetic($password)) {
            $bits += self::OUT_ALPHABET_LEVEL_BIT;
        }

        return $bits;
    }

    /**
     * @param string $password
     * @param float  $levelBit
     * @param int    $levelStart
     * @param int    $levelEnd
     * 
     * @return float
     */
    private function calculateLevel(string $password, float $levelBit, int $levelStart, int $levelEnd): float
    {
        $substr = mb_strimwidth($password, $levelStart, $levelEnd);

        return $levelBit * strlen($substr);
    }

    /**
     * @param string $password
     * 
     * @return bool
     */
    private function hasNonAlphabetic(string $password): bool
    {
        preg_match_all("/\W|[A-Z]/", $password, $matches);
        
        return count($matches[0]) > 0 ? true : false;
    }
}
