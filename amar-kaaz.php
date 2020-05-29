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

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Amar_Kaaz
{

    /**
     * Plugin version
     * 
     * @var version | string
     */
    const version = '1.0';

    /**
     * class constructor
     */
    private function __construct()
    {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instances
     * 
     * @return \Amar_Kaaz
     */
    public static function init()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * Define the required plugin constants
     * 
     * @return void
     */
    public function define_constants()
    {
        define('AMAR_KAAZ_VERSION', self::version);
        define('AMAR_KAAZ_FILE', __FILE__);
        define('AMAR_KAAZ_PATH', __DIR__);
        define('AMAR_KAAZ_URL', plugins_url('', AMAR_KAAZ_FILE));
        define('AMAR_KAAZ_PUBLIC', AMAR_KAAZ_URL . '/public');
    }

    /**
     * Initialze the plugin
     * 
     * @return void
     */
    public function init_plugin()
    {
        // loading assets
        new Amar\Kaaz\Assets();

        if (is_admin()) {
            new Amar\Kaaz\Admin();
        }
    }

    /**
     * Do stuff upon plugin activation
     * 
     * @return void
     */
    public function activate()
    {
        (new Amar\Kaaz\Installer())->run();
    }
}

/**
 * Initializes the main plugin
 * 
 * @return \Amar_Kaaz
 */
function amar_kaaz()
{
    return Amar_Kaaz::init();
}

// Kick-off the plugin
amar_kaaz();
