<?php

namespace Amar\Kaaz\Admin;

/**
 * The menu handler class
 */
class Menu {
    
    /**
     * @var Amar\Kaaz\Admin\HomePage $homepage
     */
    protected $homepage;

    /**
     * Initialze the menu class
     */
    function __construct( $homepage ) {
        $this->homepage = $homepage;
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Register admin menu
     * 
     * @return void
     */
    public function admin_menu() {
        $parent_slug = 'amar-kaaz';
        $capability  = 'manage_options';

        $hook = add_menu_page (
            __('Amar Kaaz', 'amar-kaaz'),
            __('Amar Kaaz', 'amar-kaaz'),
            $capability,
            $parent_slug,
            [$this->homepage, 'plugin_page'],
            'dashicons-welcome-learn-more'
        );
    }

}