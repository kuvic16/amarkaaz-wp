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

    public function find_by_name($name)
    {
        DB::table(self::$table_name)->find_by(['name' => $name]);
    }
    
    
}
