<?php

declare(strict_types=1);

namespace PHPTCloud\PasswordEntropyBundle\Validator;

use PHPTCloud\PasswordEntropyBundle\Service\NistEntropyCalculator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NistEntropyValidator extends ConstraintValidator
{
    private NistEntropyCalculator $calculator;

    public function __construct()
    {
        $this->calculator = new NistEntropyCalculator();
    }

    /**
     * @param string     $value
     * @param Constraint $constraint
     * 
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof NISTEntropy) {
            throw new UnexpectedTypeException($constraint, NISTEntropy::class);
        }

        if ($this->calculator->checkLevel($value) < $constraint->level) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
