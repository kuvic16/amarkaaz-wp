<?php

namespace Amar\Kaaz;

/**
 * Plugin Installer class
 */
class Installer {

    /**
     * Run the installer
     * 
     * @return void
     */
    public function run() {
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Add plugin version
     * 
     * @return void
     */
    public function add_version() {
        $installed = get_option('amar_kaaz_installed');
        if ( ! $installed ) {
            update_option('amar_kaaz_installed', time());
        }
        update_option('amar_kaaz_version', AMAR_KAAZ_VERSION);
    }

    /**
     * Create plugin required tables by schema
     */
    public function create_tables() {

    }
}