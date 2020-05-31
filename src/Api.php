<?php

namespace Amar\Kaaz;

/**
 * API Class
 */
class Api
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_api']);
    }

    /**
     * Register the all api
     * 
     * @return void
     */
    public function register_api()
    {
        (new API\HomeController())->regiester_routes();
    }
}
