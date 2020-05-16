<?php

/**
 * Plugin Name: Amar Kaaz
 * Description: A new way to manage personal task aiming to keep focusing
 * Plugin URL: https://amarkaaz.com
 * Author: Shaiful Islam Palash
 * Author URL: https://sheemoul.wordpress.com
 * Version: 1.0
 * License: GPLv2 in
 * License URL: https://www.gnu.org/licenses/gpl-2.0.html
 */

if(!defined('ABSPATH')){
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Amar_Kaaz{
    
    /**
     * Plugin version
     * 
     * @var version | string
     */
    const version = '1.0';

    /**
     * class constructor
     */
    private function __construct(){

    }

    public static function init() {
        
    }
}