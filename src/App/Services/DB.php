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
            'number'  => 20,
            'offset'  => 0,
            'orderby' => 'id',
            'order'   => 'ASC'
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

    /**
     * Get the count of total rows
     * 
     * @return int
     */
    function count()
    {
        global $wpdb;
        return (int) $wpdb->get_var("SELECT count(id) from {$wpdb->prefox}{$this->table_name}");
    }

    /**
     * Fetch a single row
     * 
     * @param int $id
     * 
     * @return object
     */
    function detail($id)
    {
        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT *FROM {$wpdb->prefix}{$this->table_name} WHERE id=%d", $id)
        );
    }

    /**
     * Delete an row
     * 
     * @param int $id
     * 
     * @return int|boolean
     */
    function delete($id)
    {
        global $wpdb;

        return $wpdb->delete(
            $wpdb->prefix . $this->table_name,
            ['id' => $id],
            ['%d']
        );
    }

    /**
     * Create or Update the records
     * 
     * @param array $args
     * 
     * @return int|WP_Error
     */
    function save($args = [])
    {
        global $wpdb;

        if (empty($args['name'])) {
            return new \WP_Error(
                'no-name',
                __('You must provide a name', 'plugin-dev')
            );
        }

        $defaults = [
            'created_by' => get_current_user_id(),
            'created_at' => current_time('mysql')
        ];


        $data = wp_parse_args($args, $defaults);
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            $updated = $wpdb->update(
                $wpdb->prefix . 'pd_addresses',
                $data,
                ['id' => $id],
                [
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s'
                ],
                ['%d']
            );
            return $updated;
        } else {
            $inserted = $wpdb->insert(
                "{$wpdb->prefix}pd_addresses",
                $data,
                [
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s'
                ]
            );

            if (!$inserted) {
                return new \WP_Error(
                    'failed-to-insert',
                    __('Failed to insert data', 'plugin-dev')
                );
            }
        }
        return $wpdb->insert_id;
    }
}
