<?php

namespace Amar\Kaaz\App\Services;

/**
 * Database class controller
 */
class DB
{

    /**
     * Table name to operate database functions
     * 
     * @var string
     */
    protected $table_name;

    /**
     * Initialize the DB class
     * 
     * @param string $table_name
     */
    public static function table($table_name)
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        $instance->table_name = $table_name;
        return $instance;
    }

    /**
     * Get list of rows
     * 
     * @param array $args['number', 'offset', 'orderby', 'order']
     * 
     * @return array
     * 
     */
    public function get($args = [])
    {
        global $wpdb;

        $defaults = [
            'number' => 20,
            'offset' => 0,
            'orderby' => 'id',
            'order' => 'ASC'
        ];

        $args = wp_parse_args($args, $defaults);
        $items = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * from {$wpdb->prefix}{$this->table_name}
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
                $args['offset'],
                $args['number']
            )
        );

        return $items;
    }
}
