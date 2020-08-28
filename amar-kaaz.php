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

use DI\ContainerBuilder;

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use Amar\Kaaz\Core\Router;

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
        // define('WP_DEBUG', true);
        // define('WP_DEBUG_LOG', true);
        // define('WP_DEBUG_DISPLAY', true);
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
            if (defined('DOING_AJAX') && DOING_AJAX) {
                Router::load(__DIR__ . '/src/Routes/api.php')->direct($_GET['action'], $_SERVER['REQUEST_METHOD']);
            }
        }
        //new Amar\Kaaz\Api();
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
