<?php

declare(strict_types=1);

namespace PasswordEntropyBundle\Validator;

use PasswordEntropyBundle\Service\OccurrenceEntropyCalculator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class OccurrenceEntropyValidator extends ConstraintValidator
{
    private OccurrenceEntropyCalculator $calculator;

    public function __construct()
    {
        $this->calculator = new OccurrenceEntropyCalculator();
    }

    /**
     * @param string     $value
     * @param Constraint $constraint
     * 
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof OccurrenceEntropy) {
            throw new UnexpectedTypeException($constraint, OccurrenceEntropy::class);
        }

        if ($this->calculator->checkLevel($value) < $constraint->level) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}