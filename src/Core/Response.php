<?php

namespace Amar\Kaaz\Core;

use Exception;

/**
 * Response class
 */
class Response
{
    /**
     * Sent wordpress json success response
     * 
     * @param array $data
     * 
     * @return json
     */
    public static function success($data)
    {
        wp_send_json_success($data);
    }

    /**
     * Sent wordpress json error response
     * 
     * @param array $data
     * 
     * @return json
     */
    public static function error($data)
    {
        wp_send_json_error($data);
    }
}
