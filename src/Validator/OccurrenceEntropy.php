<?php

declare(strict_types=1);

namespace PasswordEntropyBundle\Validator;

use Doctrine\Common\Annotations\Annotation;
use Symfony\Component\Validator\Constraint;
use PasswordEntropyBundle\Interfaces\PasswordEntropyLevelInterface;

/**
 * @Annotation
 */
class OccurrenceEntropy extends Constraint
{
    public string $message = 'Too weak password, many recurring characters';
    public int $level = PasswordEntropyLevelInterface::THIRD_STRENGHT_LEVEL;

    /**
     * @return string
     */
    public function validatedBy(): string
    {
        return OccurrenceEntropyValidator::class;
    }
}