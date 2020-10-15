<?php

namespace Amar\Kaaz\App\Controllers;

use Exception;

/**
 * Custom service exception
 */
class ServiceException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);   
    }
}