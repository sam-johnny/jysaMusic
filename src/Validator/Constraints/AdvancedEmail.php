<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class AdvancedEmail extends Constraint
{
    public string $message = 'L\'adresse email "{{ value }}" n\'est pas valide.';

    public function validatedBy():string
    {
        return get_class($this).'Validator';
    }
}