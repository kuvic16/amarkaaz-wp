<?php

namespace Amar\Kaaz\App\Services;

use Amar\Kaaz\App\Services\DB;

/**
 * Abstract service
 * 
 * @author Shaiful Islam Palash <kuvic16@gmail.com>
 * @version
 */
abstract class AbstractService
{
    /**
     * Respected table name of the service
     * @var string
     */
    protected $table_name;

    /**
     * Constructor of abstract service
     * @return void
     */
    public function __construct($table_name)
    {
        $this->table_name = $table_name;
    }

    /**
     * Find by id
     * 
     * @param int $id
     * 
     * @return obj
     */
    public function find_by_id($id)
    {
        return DB2::table($this->table_name)->find_by_id($id);
    }

    /**
     * Get all the records of respoected table
     * @return
     */
    public function get_all()
    {
        return DB::table($this->table_name)->get_all();
    }


}