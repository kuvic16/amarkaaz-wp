<?php

namespace Amar\Kaaz\Admin;

/**
 * Homepage handler class
 */
class HomePage {

    /**
     * Initialize the class
     */
    function __construct() {

    }

    public function plugin_page() {
        $template = __DIR__ . '/views/home-page.php';

        if( file_exists($template) ) {
            include $template;
        }
    }

}