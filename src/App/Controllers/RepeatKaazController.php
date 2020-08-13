<?php

namespace Amar\Kaaz\App\Controllers;

use Amar\Kaaz\App\Services\DB;
use Amar\Kaaz\Core\Request;
use Amar\Kaaz\Core\Response;

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

    /**
     * Store the RepeatKaaz
     * 
     * @return json
     */
    public function store()
    {
        $request = Request::json();

        if (!wp_verify_nonce($request['_wpnonce'], 'amar-kaaz-admin-nonce')) {
            Response::error([
                'message' => 'Nonce verification failed!'
            ]);
        }

        Response::success([
            'message' => 'Dashboard api completed store'
        ]);
    }

    /**
     * Update the RepeatKaaz
     * 
     * @return json
     */
    public function update()
    {
        wp_send_json_success([
            'message' => 'Dashboard api completed update'
        ]);
    }
}
