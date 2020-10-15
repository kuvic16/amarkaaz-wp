<?php

namespace Amar\Kaaz;

/**
 * Plugin Installer class
 */
class Installer
{

    /**
     * Run the installer
     * 
     * @return void
     */
    public function run()
    {
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Add plugin version
     * 
     * @return void
     */
    public function add_version()
    {
        $installed = get_option('amar_kaaz_installed');
        if (!$installed) {
            update_option('amar_kaaz_installed', time());
        }
        update_option('amar_kaaz_version', AMAR_KAAZ_VERSION);
    }

    /**
     * Create plugin required tables by schema
     * 
     * @return void
     */
    public function create_tables()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        if (!function_exists(dbDelta)) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        /**
         * table: kaaz_types table
         */
        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}amrkz_kaaz_types` (
            `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(250) NOT NULL,
            `color` VARCHAR(10) NOT NULL,
            `created_at` DATETIME NOT NULL,
            `created_by` INTEGER UNSIGNED NO NULL,
            `updated_at` DATETIME NOT NULL,
            `updated_by` INTEGER UNSIGNED NO NULL,
            PRIMARY KEY (`id`)
          )$charset_collate";

        dbDelta($schema);

        /**
         * table: repeat_kaazs table
         */
        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}amrkz_repeat_kaazs` (
            `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(250) NOT NULL,
            `kaaz_type_id` INTEGER NOT NULL,
            `repeat_policy` VARCHAR(50) NOT NULL,
            `start_time` VARCHAR(7) NULL,
            `end_time` VARCHAR(7) NULL,
            `created_at` DATETIME NOT NULL,
            `created_by` INTEGER UNSIGNED NO NULL,
            `updated_at` DATETIME NOT NULL,
            `updated_by` INTEGER UNSIGNED NO NULL,
            PRIMARY KEY (`id`)
          )$charset_collate";

        dbDelta($schema);

        /**
         * table: kaazs table
         */
        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}amrkz_kaazs` (
            `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(250) NOT NULL,
            `kaaz_type_id` INTEGER NOT NULL,
            `date` DATE NOT NULL,
            `start_time` DATETIME,
            `end_time` DATETIME,
            `repeat_kaaz_id` INTEGER NOT NULL,
            `created_at` DATETIME NOT NULL,
            `created_by` INTEGER UNSIGNED NO NULL,
            `updated_at` DATETIME NOT NULL,
            `updated_by` INTEGER UNSIGNED NO NULL,
            PRIMARY KEY (`id`)
          )$charset_collate";

        dbDelta($schema);
    }
}
