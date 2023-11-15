<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class PasswordConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        // Check if the password meets the specified requirements
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
