<?php

namespace Amar\Kaaz;

/**
 * Assets handlers class
 */
class Assets {

    /**
     * Initialize the class
     */
    function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    /**
     * enqueue assets
     */
    public function enqueue_assets() {
        
    }
}