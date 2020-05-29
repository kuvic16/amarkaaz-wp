<?php

namespace Amar\Kaaz;

/**
 * The admin class
 */
class Admin
{

    /**
     * Initialize the menu class
     */
    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Register admin menu
     * 
     * @return void
     */
    public function admin_menu()
    {
        $parent_slug = 'amar-kaaz';
        $capability  = 'manage_options';

        $hook = add_menu_page(
            __('Amar Kaaz', 'amar-kaaz'),
            __('Amar Kaaz', 'amar-kaaz'),
            $capability,
            $parent_slug,
            [$this, 'plugin_page'],
            'dashicons-list-view'
        );

        // enqueue the admin assets (scripts + styles)
        add_action('admin_head-' . $hook, [$this, 'enqueue_admin_assets']);
    }

    /**
     * enqueue admin assets those are register into Amar\Kaaz\Assets
     * 
     * @return void
     */
    public function enqueue_admin_assets()
    {
        wp_enqueue_style('amar-kaaz-admin-style');
        wp_enqueue_script('amar-kaaz-admin-script');
    }

    /**
     * Plugin page
     * 
     * @return void
     */
    public function plugin_page()
    {
        echo '<div id="app"></div>';
    }
}
