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
        if ( is_admin() ) {
            add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
        } else {
            add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        }        
    }

    /**
     * Get list of scripts
     * 
     * @return array
     */
    public function get_scripts() {
        return [
            'amar-kaaz-admin-script' => [
                'src'       => AMAR_KAAZ_PUBLIC . '/js/app.js',
                'version'   => filemtime(AMAR_KAAZ_PATH . '/public/js/app.js'),
                'deps'      => [],
                'in_footer' => true
            ]
        ];
    }

    /**
     * Get list of styles
     * 
     * @return array
     */
    public function get_styles() {
        return [
            'amar-kaaz-admin-style' => [
                'src'     => AMAR_KAAZ_PUBLIC . '/css/app.css',
                'version' => filemtime(AMAR_KAAZ_PATH . '/public/css/app.css')
            ]
        ];
    }

    /**
     * Reqister the assets
     * 
     * @return void
     */
    public function enqueue_assets() {
        $scripts = $this->get_scripts();
        foreach( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;
            wp_register_script(
                $handle,
                $script['src'],
                $deps,
                $script['version'],
                $in_footer
            );
        }

        $styles = $this->get_styles();
        foreach( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;
            wp_register_style(
                $handle,
                $style['src'],
                $deps,
                $style['version']
            );
        }
    }
}