<?php

namespace Amar\Kaaz\App\Controllers;

use Amar\Kaaz\App\Services\DB;

/**
 * Home controller class
 */
class HomeController
{

    /**
     * Method against dashboard api
     */
    public function dashboard()
    {
        $list = DB::table('amrkz_kaazs')->get();
        wp_send_json_success([
            'message' => 'Dashboard api completed'
        ]);
    }
}
