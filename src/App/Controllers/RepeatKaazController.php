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
        $d = $request->all();
        var_dump($d);
        die;
        $data = json_decode(file_get_contents('php://input'), true);
        print_r($data);
        //$_POST = json_decode(file_get_contents('php://input'), true);
        //var_dump($_POST);
        die;

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
