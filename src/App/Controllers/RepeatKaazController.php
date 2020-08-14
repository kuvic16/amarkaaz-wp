<?php

namespace Amar\Kaaz\App\Controllers;

use Amar\Kaaz\App\Services\DB;
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
                'message' => 'Nonce verification failed!'
            ]);
        }



        Response::success([
            'message' => 'Dashboard api completed store'
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

        if (empty($name)) {
            $this->errors['name'] = __('Please provide a name', 'plugin-dev');
        }

        if (empty($phone)) {
            $this->errors['phone'] = __('Please provide a number', 'plugin-dev');
        }

        if (!empty($this->errors)) {
            return;
        }

        $args = [
            'name' => $name,
            'address' => $address,
            'phone' => $phone
        ];
    }
}
