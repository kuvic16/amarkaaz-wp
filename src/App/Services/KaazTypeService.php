<?php

namespace Amar\Kaaz\App\Services;

/**
 * Kaaz type service
 */
class KaazTypeService
{
    /**
     * Respected table name of the service
     * @var string
     */
    protected static $table_name = "repeat_kaazs";
    
    /**
     * Service class constructor
     */
    public function __construct()
    {
    }

    public function get_all()
    {
        return DB::table(self::$table_name)->get_all(['orderby' => 'name', 'order' => 'asc']);
    }

    /**
     * Find by name
     * 
     * @param string $name
     * @return obj
     */
    public function find_by_name($name)
    {
        return DB::table(self::$table_name)->where(['name' => $name])->first();
    }
    
    
}
