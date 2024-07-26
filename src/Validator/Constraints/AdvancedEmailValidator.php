<?php

namespace App\Validator\Constraints;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class AdvancedEmailValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof AdvancedEmail) {
            throw new UnexpectedTypeException($constraint, AdvancedEmail::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $validator = new EmailValidator();
        if (!$validator->isValid($value, new RFCValidation())) {

            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

}