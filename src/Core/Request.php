<?php

namespace Amar\Kaaz\Core;

use Exception;

/**
 * Request class
 */
class Request
{
    /**
     * Get json request payload
     * 
     * @return json
     */
    public static function json()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
