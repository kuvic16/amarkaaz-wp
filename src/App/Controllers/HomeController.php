<?php

namespace Amar\Kaaz\App\Controllers;

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
        wp_send_json_success([
            'message' => 'Dashboard api completed'
        ]);
    }
}
