<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

#[Serializer\ExclusionPolicy('all')]
class ErrorResponse
{
    #[Serializer\Expose()]
    #[Serializer\Type('string')]
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}