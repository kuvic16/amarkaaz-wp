<?php

namespace Amar\Kaaz\App\Controllers;

use Amar\Kaaz\App\Constants\IRepeatKaaz;
use Amar\Kaaz\App\Services\DB;
use Amar\Kaaz\App\Services\KaazTypeService;
use Amar\Kaaz\App\Services\RepeatKaazService;
use Amar\Kaaz\Core\Request;
use Amar\Kaaz\Core\Response;
use Exception;

/**
 * Rpeat kaaz controller class
 */
class RepeatKaazController
{
    /**
     * Repeat kaaz service
     * 
     * @var App\Services\RepeatKaazService $repeat_kaaz_service
     */
    protected $repeat_kaaz_service;

    /**
     * Repeat kaaz service
     * 
     * @var App\Services\KaazTypeService $kaaz_type_service
     */
    protected $kaaz_type_service;

    /**
     * Class contstructor
     */
    public function __construct()
    {
        if (!current_user_can('manage_options')) {
            Response::error([
                'message' => __('You are not authorized!', 'amar-kaaz')
            ]);
        }

        $this->repeat_kaaz_service = new RepeatKaazService();
        $this->kaaz_type_service = new KaazTypeService();
    }

    /**
     * Get the all initial data require for RepeatKaaz page
     * 
     * @return json
     */
    public function init()
    {
        $kaaz_type_list = $this->kaaz_type_service->get_all();
        $id = $_GET['id'];
        if(intval($id) > 0) {
            
        }
        Response::success([
            'kaaz_type_list' => $kaaz_type_list,
            'id' => $id
        ]);
    }

    /**
     * Get the list of repeat kaaz
     * 
     * @return json
     */
    public function _list()
    {
        $page = intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
        $repeat_kaaz = $this->repeat_kaaz_service->get_by($page, 10);
        Response::success([
            'repeat_kaaz' => $repeat_kaaz
        ]);
    }

    /**
     * Store the RepeatKaaz
     * 
     * @return json
     */
    public function store()
    {
        $request = Request::json();

        // Nonce verification
        if (!wp_verify_nonce($request['_wpnonce'], 'amar-kaaz-admin-nonce')) {
            Response::error([
                'message' => __('Nonce verification failed!', 'amar-kaaz')
            ]);
        }

        // request validation
        $result = $this->validate($request);
        if (count($result['errors']) > 0) {
            Response::error([
                'message' => __('Validation failed!', 'amar-kaaz'),
                'errors'  => $result['errors']
            ]);
        }

        // save the request
        try{
            $this->repeat_kaaz_service->create($result['args']);
        } catch(Exception $ex) {
            Response::error([
                'message' => $ex->getMessage()
            ]);
        }

        Response::success([
            'message' => __('Dashboard api completed store', 'amar-kaaz')
        ]);
    }

    /**
     * Update the RepeatKaaz
     * 
     * @return json
     */
    public function update()
    {
        wp_send_json_success([
            'message' => 'Dashboard api completed update'
        ]);
    }

    protected function validate($request)
    {
        $id            = isset($request['id']) ? intval($request['id']) : 0;
        $name          = isset($request['name']) ? sanitize_text_field($request['name']) : '';
        $kaaz_type_id  = isset($request['type_id']) ? intval($request['type_id']) : 0;
        $repeat_policy = isset($request['repeat_policy']) ? sanitize_text_field($request['repeat_policy']) : '';

        $start_month   = isset($request['start_month']) ? sanitize_text_field($request['start_month']) : '';
        $start_day     = isset($request['start_day']) ? sanitize_text_field($request['start_day']) : '';
        $start_time    = isset($request['start_time']) ? sanitize_text_field($request['start_time']) : '';

        $end_month     = isset($request['end_month']) ? sanitize_text_field($request['end_month']) : '';
        $end_day       = isset($request['end_day']) ? sanitize_text_field($request['end_day']) : '';
        $end_time      = isset($request['end_time']) ? sanitize_text_field($request['end_time']) : '';

        $this->errors = [];
        if (empty($name)) {
            $this->errors['name'] = __('Please provide a name', 'amar-kaaz');
        }

        if (empty($kaaz_type_id)) {
            $this->errors['kaaz_type_id'] = __('Please provide a type', 'plugin-dev');
        }

        if (empty($repeat_policy)) {
            $this->errors['repeat_policy'] = __('Please provide a repeat policy', 'plugin-dev');
        } elseif (!in_array($repeat_policy, [IRepeatKaaz::$POLICY_DAILY, IRepeatKaaz::$POLICY_WEEKDAY, IRepeatKaaz::$POLICY_WEEKEND, IRepeatKaaz::$POLICY_MONTHLY, IRepeatKaaz::$POLICY_YEARLY])) {
            $this->errors['repeat_policy'] = __('Please provide a currect repeat policy', 'plugin-dev');
        }

        $time_regex = '/[0-9]{2}:(00|15|30|45)(am|pm)/';
        $ampm_regex = '/am|pm/';
        if (empty($start_time)) {
            $this->errors['start_time'] = __('Please provide a start time', 'plugin-dev');
        } elseif (preg_match($time_regex, $start_time) == 0) {
            $this->errors['start_time'] = __('Please provide a valid start time', 'plugin-dev');
        } else {
            [$start_hour, $start_minute] = array_map('intval', explode(':', preg_replace($ampm_regex, '', $start_time)));
            if ($start_hour <= 0 || $start_hour > 12 || !in_array($start_minute, [0, 15, 30, 45])) {
                $this->errors['start_time'] = __('Please provide a valid start time', 'plugin-dev');
            }
        }

        if (empty($end_time)) {
            $this->errors['end_time'] = __('Please provide a end time', 'plugin-dev');
        } elseif (preg_match($time_regex, $end_time) == 0) {
            $this->errors['end_time'] = __('Please provide a valid end time', 'plugin-dev');
        } else {
            [$end_hour, $end_minute] = array_map('intval', explode(':', preg_replace($ampm_regex, '', $end_time)));
            if ($end_hour <= 0 || $end_hour > 12 || !in_array($end_minute, [0, 15, 30, 45])) {
                $this->errors['end_time'] = __('Please provide a valid end time', 'plugin-dev');
            }
        }

        if ($repeat_policy === IRepeatKaaz::$POLICY_MONTHLY || $repeat_policy === IRepeatKaaz::$POLICY_YEARLY) {
            if (empty($start_day)) {
                $this->errors['start_day'] = __('Please provide a start day', 'plugin-dev');
            } elseif (intval($start_day) <= 0 || intval($start_day) > 31) {
                $this->errors['end_time'] = __('Please provide correct start day', 'plugin-dev');
            }

            if (empty($end_day)) {
                $this->errors['end_day'] = __('Please provide a end day', 'plugin-dev');
            } elseif (intval($end_day) <= 0 || intval($end_day) > 31) {
                $this->errors['end_day'] = __('Please provide correct end day', 'plugin-dev');
            }
        }

        if ($repeat_policy === IRepeatKaaz::$POLICY_YEARLY) {
            if (empty($start_month)) {
                $this->errors['start_month'] = __('Please provide a start month', 'plugin-dev');
            } elseif (intval($start_month) <= 0 || intval($start_month) > 12) {
                $this->errors['start_month'] = __('Please provide correct start month', 'plugin-dev');
            }

            if (empty($end_month)) {
                $this->errors['end_month'] = __('Please provide a end month', 'plugin-dev');
            } elseif (intval($end_month) <= 0 || intval($end_month) > 12) {
                $this->errors['end_month'] = __('Please provide correct end month', 'plugin-dev');
            }
        }

        $args = [
            'id'            => intval($id),
            'name'          => $name,
            'kaaz_type_id'  => intval($kaaz_type_id),
            'repeat_policy' => $repeat_policy,
            'start_month'   => intval($start_month),
            'start_day'     => intval($start_day),
            'start_time'    => $start_time,
            'end_month'     => intval($end_month),
            'end_day'       => intval($end_day),
            'end_time'      => $end_time
        ];

        return [
            'errors' => $this->errors,
            'args'   => $args
        ];
    }
}
