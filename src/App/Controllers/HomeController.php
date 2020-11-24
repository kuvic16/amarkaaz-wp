<?php

namespace Amar\Kaaz\App\Controllers;

use Amar\Kaaz\App\Services\DB;
use Amar\Kaaz\Core\Response;

/**
 * Home controller class
 */
class HomeController
{
    /**
     * Class contstructor
     */
    public function __construct()
    {
    }

    /**
     * Method against dashboard api
     */
    public function dashboard()
    {
        global $wpdb;
        $sql = "select * from {$wpdb->prefix}amrkz_kaazs";
        $param = [];
        $list = DB::get_query($sql, $param);
        Response::success([
            'message' => 'Dashboard api completed',
            'list' => $list
        ]);
    }
}
