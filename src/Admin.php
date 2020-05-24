<?php

namespace Amar\Kaaz;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the menu class
     */
    function __construct() {
        $homepage = new Admin\HomePage();
        new Admin\Menu($homepage);   
    }
}