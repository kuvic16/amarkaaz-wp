<?php

namespace Amar\Kaaz\App\Services;

use Amar\Kaaz\App\Constants\ITables;
use Amar\Kaaz\App\Controllers\AlreadyExistException;
use Amar\Kaaz\App\Controllers\ServiceException;
use Exception;

/**
 * Repeat kaaz service
 */
class RepeatKaazService extends AbstractService
{
    /**
     * Service class constructor
     */
    public function __construct()
    {
        parent::__construct(ITables::$REPEAT_KAAZS);
    }

     /**
     * Get all the records of repeat kaaz
     * 
     * @return array|null
     */
    public function get_all()
    {
        return DB2::table(self::$table_name, 'rk')
                ->inner_join(ITables::$KAAZ_TYPES, 'kt', 'kt.id = rk.kaaz_type_id')
                ->select(['rk.*', 'kt.name as kaaz_type_name'])
                ->order_by('rk.created_at desc')
                ->get();
    }

    /**
     * Get the records based on parameters
     * 
     * @param int $page - default 1
     * @param int $limit - default 10
     * 
     * @return array|null
     */
    public function get_by($page = 1, $limit = 10)
    {
        return DB2::table(self::$table_name, 'rk')
                ->inner_join(ITables::$KAAZ_TYPES, 'kt', 'kt.id = rk.kaaz_type_id')
                ->select(['rk.*', 'kt.name as kaaz_type_name'])
                ->order_by('rk.created_at desc')
                ->page($page)
                ->limit($limit)
                ->pagination();
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
        $exist = DB::table(self::$table_name)
                ->where(['name' => $args['name']])->first();
        
        if($exist) {
            throw new Exception(__('Already exist!', 'amar-kaaz'));
        }

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

        $id = DB::table(self::$table_name)->create($data);        

        if ($id === null) {
            throw new Exception(__('Failed to insert data!', 'amar-kaaz'));            
        }
        return $id;
    }

    /**
     * Update the repeat_kaazs
     * 
     * @param array $args
     * 
     * @return int|WP_Error
     */
    function update($args = [])
    {
        $exist = DB2::table(self::$table_name)
                ->where(['name' => $args['name', 'id' ]])->first();
        
        if($exist) {
            throw new Exception(__('Already exist!', 'amar-kaaz'));
        }

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

        $id = DB::table(self::$table_name)->create($data);        

        if ($id === null) {
            throw new Exception(__('Failed to insert data!', 'amar-kaaz'));            
        }
        return $id;
    }
}
