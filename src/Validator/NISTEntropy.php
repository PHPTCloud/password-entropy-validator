<?php

declare(strict_types=1);

namespace PHPTCloud\PasswordEntropyBundle\Validator;

use Doctrine\Common\Annotations\Annotation;
use PHPTCloud\PasswordEntropyBundle\Interfaces\PasswordEntropyLevelInterface;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NISTEntropy extends Constraint
{
    public string $message = 'Too weak password';
    public int $level = PasswordEntropyLevelInterface::THIRD_STRENGHT_LEVEL;

    /**
     * @return string
     */
    public function validatedBy(): string
    {
        return NistEntropyValidator::class;
    }
}
