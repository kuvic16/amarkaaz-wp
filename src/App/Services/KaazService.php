<?php

namespace Amar\Kaaz\App\Services;

use Amar\Kaaz\App\Constants\IRepeatKaaz;
use Amar\Kaaz\App\Constants\ITables;
use Amar\Kaaz\App\Controllers\AlreadyExistException;
use Amar\Kaaz\App\Controllers\ServiceException;
use DateTime;
use Exception;

/**
 * Repeat kaaz service
 */
class KaazService extends AbstractService
{
    /**
     * Repeat kaaz service
     * 
     * @var App\Services\RepeatKaazService $repeat_kaaz_service
     */
    protected $repeat_kaaz_service;

    /**
     * Service class constructor
     */
    public function __construct()
    {
        parent::__construct(ITables::$KAAZS);
        $this->repeat_kaaz_service = new RepeatKaazService();
    }

    /**
     * Generate upcoming kaaz
     * 
     * @param string
     * 
     * @return void
     */
    public function upcoming_kaaz()
    {
        $repeat_kaaz_list = $this->repeat_kaaz_service->get_all();
        foreach($repeat_kaaz_list as $repeat_kaaz) {
            try {
                // create a daily kaaz based on repeat kaaz
                if ($repeat_kaaz->repeat_policy === IRepeatKaaz::$POLICY_DAILY) {
                    $start_time = date("Y-m-d");
                    $start_time .= " " . $repeat_kaaz->start_time;

                    $end_time = date("Y-m-d");
                    $end_time .= " " . $repeat_kaaz->end_time;
                            
                    $n_daily_kaaz = [
                        'name'           => $repeat_kaaz->name,
                        'kaaz_type_id'   => $repeat_kaaz->kaaz_type_id,
                        'repeat_kaaz_id' => $repeat_kaaz->id,
                        'start_time'     => new DateTime($start_time),
                        'end_time'       => new DateTime($end_time),
                        'is_completed'   => false
                    ];
                    $this->create($n_daily_kaaz);  
                    die;                  
                }
            }catch(\Exception $ex) {
                var_dump($ex->getMessage());
            }
        }
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
        //var_dump(self::$table_name);
        //var_dump($args['name']);
        //die;
        $exist = DB2::table(self::$table_name)
                ->where(['name' => $args['name']])
                ->first();

                var_dump($exist);
                die;
        
        if($exist) {
            throw new Exception(__('Already exist!', 'amar-kaaz'));
        }

        $defaults = [
            'created_by' => get_current_user_id(),
            'created_at' => current_time('mysql')
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
        $exist = DB2::table(self::$table_name, 'rk')
                ->where(['name' => $args['name']])
                ->where(['id', '!=', $args['id']])
                ->first();
        
        if($exist) {
            throw new Exception(__('Already exist!', 'amar-kaaz'));
        }

        $defaults = [
            'updated_by' => get_current_user_id(),
            'updated_at' => current_time('mysql')
        ];
        $data = wp_parse_args($args, $defaults);

        DB2::table(self::$table_name)->save($data);
    }

    /**
     * delete the repeat_kaazs
     * 
     * @param integer $id
     * 
     * @return int|WP_Error
     */
    function delete($id)
    {
        $exist = DB2::table(self::$table_name)->find_by_id($id);
        if(!$exist) {
            throw new Exception(__('Not found!', 'amar-kaaz'));
        }
        DB2::table(self::$table_name)->delete($id);
    }
}
