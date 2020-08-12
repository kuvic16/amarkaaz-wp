<?php

namespace Amar\Kaaz\App\Controllers;

use Amar\Kaaz\App\Services\DB;

/**
 * Rpeat kaaz controller class
 */
class RepeatKaazController
{
    /**
     * Class contstructor
     */
    public function __construct()
    {
    }


    public function store()
    {
        wp_send_json_success([
            'message' => 'Dashboard api completed store'
        ]);
    }

    public function update()
    {
        wp_send_json_success([
            'message' => 'Dashboard api completed update'
        ]);
    }
}
