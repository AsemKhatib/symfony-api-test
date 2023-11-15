<?php

namespace App\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;
#[Attribute]
class PasswordConstraint extends Constraint
{
    public string $message = 'Das Passwort muss 8 Zeichen lang sein und Groß/Kleinbuchstaben, mindestens eine Zahl und ein Sonderzeichen enthalten.';
}