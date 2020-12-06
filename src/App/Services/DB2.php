<?php

namespace Amar\Kaaz\App\Services;

/**
 * Database class controller
 */
class DB2
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
     * Inner join array
     * 
     * @var array
     */
    protected $inner_join_array;

    /**
     * Left join array
     * 
     * @var array
     */
    protected $left_join_array;

    /**
     * order by string
     * 
     * @var string
     */
    protected $order_by;

    /**
     * group by string
     * 
     * @var string
     */
    protected $group_by;

    /**
     * having string
     * 
     * @var string
     */
    protected $having;

    /**
     * result limit
     * 
     * @var int
     */
    protected $limit;

    /**
     * result page
     * 
     * @var int
     */
    protected $page;

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
        $instance->table_name = $instance->get_table($table_name);
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
        $this->inner_join_array = [];
        $this->left_join_array = [];
        $this->params_array = [];
        $this->where_array = [];
        $this->select_array = [];
        $this->order_by = "";
        $this->group_by = "";
        $this->having = "";
        $this->limit = null;
        $this->page = null;
    }

    /**
     * Get table with wordpress prefix
     * 
     * @param string $table_name
     * 
     * @return string
     */
    private function get_table($table_name) 
    {
        global $wpdb;
        return $wpdb->prefix . $table_name;
    }

    /**
     * Set the inner join table
     * 
     * @param string $join_table_name
     * @param string $on_query on query
     * 
     * @return this
     */
    public function inner_join($join_table_name, $on_query)
    {
        $join_table = $this->get_table($join_table_name);
        array_push($this->inner_join_array, $join_table . ' on ' . $on_query);
        return $this;
    }

    /**
     * Set the left join table
     * 
     * @param string $join_table_name
     * @param string $on_query on query
     * 
     * @return this
     */
    public function left_join($join_table_name, $on_query)
    {
        $join_table = $this->get_table($join_table_name);
        array_push($this->left_join_array, $join_table . ' on ' . $on_query);
        return $this;
    }
     
    /**
     * Set the where and param values
     * 
     * @param array $args
     * @return this
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
     * @return this
     */
    public function select($args = [])
    {
        foreach($args as $value) {
            array_push($this->select_array, $value);
        }   
        return $this;
    }

    /**
     * Set the group by query
     * 
     * @param string $query
     * 
     * @return this
     */
    public function group_by($query) {
        $this->group_by = $query;
        return $this;
    }

    /**
     * Set the order by query
     * 
     * @param string $query
     * 
     * @return this
     */
    public function order_by($query) {
        $this->order_by = $query;
        return $this;
    }

    /**
     * Set the having query
     * 
     * @param string $query
     * 
     * @return this
     */
    public function having($query) {
        $this->having = $query;
        return $this;
    }

    /**
     * Set the page number
     * 
     * @param int $number
     * 
     * @return this
     */
    public function page($number) {
        $this->page = $number;
        return $this;
    }

    /**
     * Set the result limit
     * 
     * @param int $limit
     * 
     * @return this
     */
    public function limit($limit) {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Prepare select query based on select array
     * 
     * @return string
     */
    private function prepare_select_query()
    {
        $select = "*";
        if(count($this->select_array) > 0) {
            $select = implode(" , ", $this->select_array);
        }
        return $select;
    }

    /**
     * Prepare query except select
     * 
     * @return string
     */
    private function prepare_query()
    {
        $query = $this->table_name;
        
        // collect inner join
        $inner_join_query = '';
        if(count($this->inner_join_array) > 0) {
            $inner_join_query = implode(' inner join  ', $this->inner_join_array);
        }
        if(!empty($inner_join_query)) {
            $query = $query . ' inner join' . $inner_join_query;
        }

        // collect left join
        $left_join_query = '';
        if(count($this->left_join_array) > 0) {
            $left_join_query = implode(' left join  ', $this->left_join_array);
        }
        if(!empty($left_join_query)) {
            $query = $query . ' left join' . $left_join_query;
        }

        // collect where condition
        $where = '';
        if(count($this->where_array) > 0) {
            $where = implode(' and ', $this->where_array);
        }
        if(!empty($where)) {
            $query = $query . ' where' . $where;
        }

        // prepare order by
        if(!empty($this->order_by)) {
            $query = $query . ' order by ' . $this->order_by;
        }

        // prepare group by
        if(!empty($this->group_by)) {
            $query = $query . ' group by ' . $this->group_by;
        }

        // prepare having by
        if(!empty($this->having)) {
            $query = $query . ' having ' . $this->having;
        }
    
        return $query;
    }

    /**
     * Prepare pagination query
     * 
     * @return string
     */
    private function prepare_pagination_query() {
        $query = "";
        if($this->limit != null && $this->page == null) {
            $query = " limit {$this->limit}";
        }

        if($this->limit != null && $this->page != null) {
            $offset = $this->limit * ($this->page - 1);
            $query = " limit $offset, {$this->limit}";
        }
        return $query;
    }

    /**
     * Count by column
     * 
     * @param string $column_name - default 'id'
     * 
     * @return int
     */
    public function count($column_name = 'id')
    {
        global $wpdb;
        $query = $this->prepare_query();
        return (int) $wpdb->get_var("SELECT count({$column_name}) from {$query}", $this->params_array);
    }

    /**
     * Find the first row
     * 
     * @return object
     */
    public function first()
    {                
        $select = $this->prepare_select_query();
        $query = $this->prepare_query();

        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT {$select} FROM {$query}", $this->params_array)
        );
    }

    /**
     * Get list of rows
     * 
     * @return array
     * 
     */
    public function get()
    {
        $select           = $this->prepare_select_query();
        $query            = $this->prepare_query();
        $pagination_query = $this->prepare_pagination_query();
        if(!empty($pagination_query)) {
            $query = "$query $pagination_query";
        }

        global $wpdb;
        return $wpdb->get_results(
            $wpdb->prepare("SELECT {$select} FROM {$query}", $this->params_array)
        );
    }
    

    /**
     * Find by id
     * 
     * @param int $id
     * 
     * @return object
     */
    function find_by_id($id)
    {
        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$this->table_name} WHERE id = %d", $id)
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
     * Execute native query to get the results
     * 
     * @param array $query
     * @param array $params
     * 
     * @return array|null
     */
    public static function get_by_native_query($query, $params)
    {
        global $wpdb;

        return $wpdb->get_results(
            $wpdb->prepare($query, $params)
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
        return $wpdb->delete($this->table_name, ['id' => $id], ['%d']);
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
        }
    }
}
