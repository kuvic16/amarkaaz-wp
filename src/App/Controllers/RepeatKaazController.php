<?php

namespace Amar\Kaaz\App\Controllers;

use Amar\Kaaz\App\Constants\IRepeatKaaz;
use Amar\Kaaz\App\Services\DB;
use Amar\Kaaz\App\Services\RepeatKaazService;
use Amar\Kaaz\Core\Request;
use Amar\Kaaz\Core\Response;

/**
 * Rpeat kaaz controller class
 */
class RepeatKaazController
{

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
    }

    /**
     * Store the RepeatKaaz
     * 
     * @return json
     */
    public function store()
    {
        $request = Request::json();

        if (!wp_verify_nonce($request['_wpnonce'], 'amar-kaaz-admin-nonce')) {
            Response::error([
                'message' => __('Nonce verification failed!', 'amar-kaaz')
            ]);
        }

        $result = $this->validate($request);
        if (count($result['errors']) > 0) {
            Response::error([
                'message' => __('Validation failed!', 'amar-kaaz'),
                'errors'  => $result['errors']
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
        $id = isset($request['id']) ? intval($request['id']) : 0;
        $name = isset($request['name']) ? sanitize_text_field($request['name']) : '';
        $type = isset($request['type']) ? sanitize_text_field($request['type']) : '';
        $repeat_policy = isset($request['repeat_policy']) ? sanitize_text_field($request['repeat_policy']) : '';

        $start_month = isset($request['start_month']) ? sanitize_text_field($request['start_month']) : '';
        $start_day = isset($request['start_day']) ? sanitize_text_field($request['start_day']) : '';
        $start_time = isset($request['start_time']) ? sanitize_text_field($request['start_time']) : '';

        $end_month = isset($request['end_month']) ? sanitize_text_field($request['end_month']) : '';
        $end_day = isset($request['end_day']) ? sanitize_text_field($request['end_day']) : '';
        $end_time = isset($request['end_time']) ? sanitize_text_field($request['end_time']) : '';

        $this->errors = [];
        if (empty($name)) {
            $this->errors['name'] = __('Please provide a name', 'amar-kaaz');
        }

        if (empty($type)) {
            $this->errors['type'] = __('Please provide a type', 'plugin-dev');
        } elseif (!in_array($type, [IRepeatKaaz::$TYPE_NICE_HAVE, IRepeatKaaz::$TYPE_MUST_HAVE])) {
            $this->errors['type'] = __('Please provide a correct type', 'plugin-dev');
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

        $args = [
            'name' => $name,
        ];

        return [
            'errors' => $this->errors,
            'args'   => $args
        ];
    }
}
