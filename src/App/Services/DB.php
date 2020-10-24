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
     * Params array
     * 
     * @var array
     */
    protected $params_array;

    /**
     * Where array
     * 
     * @var array
     */
    protected $where_array;

    /**
     * Select array
     * 
     * @var array
     */
    protected $select_array;

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
        $instance->clear();
        return $instance;
    }

    /**
     * Clear all the parameters those are used to every query
     * 
     * @return void
     */
    private function clear()
    {
        $this->params_array = [];
        $this->where_array = [];
        $this->select_array = [];
    } 

    /**
     * Set the where and param values
     * 
     * @param array $args
     * @return 
     */
    public function where($args)
    {
        foreach($args as $key => $value) {
            array_push($this->params_array, $value);
            array_push($this->where_array, "$key = " . $this->get_type($value));
        }
        return $this;
    }

    /**
     * Set the select columns into array
     * 
     * @param array $args
     * @return null
     */
    public function select($args = [])
    {
        foreach($args as $value) {
            array_push($this->select_array, $value);
        }   
        return $this;
    }

    /**
     * Find the first row
     * 
     * @return object
     */
    public function first()
    {
        $where = "";
        if(count($this->where_array) > 0) {
            $where = implode(" and ", $this->where_array);
        }
        
        $select = "*";
        if(count($this->select_array) > 0) {
            $select = implode(" , ", $this->select_array);
        }
        
        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT $select FROM {$wpdb->prefix}{$this->table_name} WHERE " . $where, $this->params_array)
        );
        return $this;
    }
    

    /**
     * Find by id
     * 
     * @param int $id
     * @return object
     */
    function finById($id)
    {
        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$wpdb->prefix}{$this->table_name} WHERE id = %d", $id)
        );
    }

    /**
     * Find by id
     * 
     * @param array $args
     * @return object
     */
    public function find_by($args)
    {
        $params_array = [];
        $where_array = [];
        foreach($args as $key => $value) {
            array_push($params_array, $value);
            array_push($where_array, "$key = " . $this->get_type($value));
        }

        $where = implode(" and ", $where_array);

        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$wpdb->prefix}{$this->table_name} WHERE " . $where, $params_array)
        );
    }


    /**
     * Get mysql data type based on data 
     * 
     * @param obj $data
     * @return string
     */
    public function get_type($data) {
        $type = gettype($data);
        if($type === 'integer') return '%d';
        if($type === 'double')  return '%f';
        else return '%s';
    }

    /**
     * Get list of all rows
     * 
     * @param array $args['orderby', 'order']
     * 
     * @return array
     * 
     */
    public function get_all($args = [])
    {
        global $wpdb;

        $defaults = [
            'orderby' => 'id',
            'order'   => 'ASC'
        ];

        $args = wp_parse_args($args, $defaults);
        $items = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * from {$wpdb->prefix}{$this->table_name}
                ORDER BY {$args['orderby']} {$args['order']}"
            )
        );

        return $items;
    }

    /**
     * Execute get query
     * 
     * @param array $query
     * @param array $params
     * @return array|null
     */
    public function get_query($query, $params)
    {
        global $wpdb;

        return $wpdb->get_results(
            $wpdb->prepare($query, $params)
        );
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
            $wpdb->prepare("SELECT * FROM {$wpdb->prefix}{$this->table_name} WHERE id=%d", $id)
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
     * Create the records
     * 
     * @param array $args
     * 
     * @return int|WP_Error
     */
    function create($data)
    {
        global $wpdb;

        $type = [];
        foreach($data as $key => $value) {
            array_push($type, $this->get_type($value));
        }        

        $inserted = $wpdb->insert(
            $wpdb->prefix . $this->table_name,
            $data,
            $type
        );

        return $inserted ? $wpdb->insert_id : null;
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
