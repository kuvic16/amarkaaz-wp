<?php

namespace Amar\Kaaz\App\Controllers;

use Exception;

/**
 * Already exist exception
 */
class AlreadyExistException extends ServiceException
{
    public function __construct()
    {
        parent::__construct(__('Already exist!', 'amar-kaaz'));
    }
}