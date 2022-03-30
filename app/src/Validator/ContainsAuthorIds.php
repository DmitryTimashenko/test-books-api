<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ContainsAuthorIds extends Constraint
{
    public $message = 'There is no author wit id {{ id }}';
}