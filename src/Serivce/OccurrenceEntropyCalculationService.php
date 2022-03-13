<?php

declare(strict_types=1);

namespace PasswordEntropyBundle\Service;

class OccurrenceEntropyCalculationService
{
    public const FIRST_STRENGHT_LEVEL = 80;  // встречается > 80%     очень слабый пароль
    public const SECOND_STRENGHT_LEVEL = 50; // встречается > 50-79%  слабый пароль
    public const THIRD_STRENGHT_LEVEL = 35;  // встречается > 35-49%  приемлемый уровень вхождения
    public const FOURTH_STRENGHT_LEVEL = 10; // встречается > 10-34%  сильный пароль
                                             // встречается < 9%      очень сильный пароль, вхождения минимальны
}