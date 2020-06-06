<?php

namespace Amar\Kaaz;

/**
 * Ajax handler class
 */
class Ajax
{
    /**
     * Initialize the class
     */
    function __construct()
    {
        add_action(
            'wp_ajax_amar_kaaz_dashboard_init',
            [
                $this,
                'dashboard_init'
            ]
        );
    }

    public function dashboard_init()
    {
        if (!wp_verify_nonce($_REQUEST['_wpnonce'])) {
            // wp_send_json_error([
            //     'message' => 'Nonce verification failed!'
            // ]);
        }

        wp_send_json_success([
            'message' => 'Dashboard init completed'
        ]);
    }
}
