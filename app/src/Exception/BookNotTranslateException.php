<?php

namespace App\Exception;

use RuntimeException;

class BookNotTranslateException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("The book has no translation in this language");
    }
}