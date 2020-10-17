<?php

namespace Amar\Kaaz\App\Services;

/**
 * Repeat kaaz service
 */
class RepeatKaazService
{
    /**
     * Respected table name of the service
     * @var string
     */
    protected static $table_name = "amrkz_repeat_kaazs";
    /**
     * Service class constructor
     */
    public function __construct()
    {
        
    }
    
    /**
     * Create the repeat_kaazs
     * 
     * @param array $args
     * 
     * @return int|WP_Error
     */
    function create($args = [])
    {
        //var_dump($args);

        $list = DB::table(self::$table_name)
                ->where([
                    'name' => $args['name']
                ])->first();
        var_dump($list);

        die;
        global $wpdb;

        $defaults = [
            'created_by' => get_current_user_id(),
            'created_at' => current_time('mysql'),
            'updated_by' => get_current_user_id(),
            'updated_at' => current_time('mysql')
        ];


        $data = wp_parse_args($args, $defaults);
        if (isset($data['id'])) {
            unset($data['id']);
        }

        $inserted = $wpdb->insert(
            $wpdb->prefix . self::$table,
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
                __('Failed to insert data', 'amar-kaaz')
            );
        }
        return $wpdb->insert_id;
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

        $defaults = [
            'created_by' => get_current_user_id(),
            'created_at' => current_time('mysql')
        ];


        $data = wp_parse_args($args, $defaults);
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            $updated = $wpdb->update(
                $wpdb->prefix . self::$table,
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
                $wpdb->prefix . self::$table,
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
                    __('Failed to insert data', 'amar-kaaz')
                );
            }
        }
        return $wpdb->insert_id;
    }
}
