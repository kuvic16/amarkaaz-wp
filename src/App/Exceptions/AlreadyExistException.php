<?php

namespace Amar\Kaaz\App\Controllers;

use Exception;

/**
 * Already exist exception
 */
class AlreadyExistException extends Exception
{
    public function errorMessage() {
        return "test";
    }
}