<?php

/**
 * Database class controller
 */
class DB
{
    /**
     * Get address
     * 
     * @param array $args
     * 
     * @return array
     * 
     */
    function get_list($args = [])
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
                "SELECT * from {$wpdb->prefix}pd_addresses
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
                $args['offset'],
                $args['number']
            )
        );

        return $items;
    }
}
