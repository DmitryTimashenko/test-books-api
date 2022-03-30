<?php

namespace App\Exception;

use RuntimeException;

class BookNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("Book with the ID not found");
    }
}