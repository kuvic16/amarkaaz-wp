<?php

namespace Amar\kaaz\API;

use WP_REST_Controller;
use WP_REST_Server;

class HomeController extends WP_REST_Controller
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->namespace = 'amarkaaz/v1';
        $this->rest_base = 'home';
    }

    /**
     * Register all routes for this controller
     * 
     * @return void
     */
    public function regiester_routes()
    {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_items'],
                    'permission_callback' => [$this, 'get_items_permissions_check'],
                    'args'                => $this->get_collection_params()
                ],
                'schema' => [$this, 'get_item_schema']
            ]
        );
    }

    /**
     * Checks if a given request has access to read contacts
     * 
     * @param \WP_REST_Request $request
     * 
     * @return boolean
     */
    public function get_items_permissions_check($request)
    {
        if (current_user_can('manage_options')) {
            return true;
        }
        return false;
    }

    /**
     * Get
     */
    public function get_items($request)
    {
        $data =  [
            'success' => true,
            'message' => 'This is just a message'
        ];
        $response = rest_ensure_response($data);

        //$response->header( 'X-WP-Total', (int) $1 );
        //$response->header( 'X-WP-TotalPages', (int) $max_pages );

        return $response;
    }

    public function get_item_schema()
    {
        if ($this->schema) {
            return $this->add_additional_fields_schema($this->schema);
        }

        $schema = [
            '$schema'    => 'http://json-shcema.org/draft-84/schema',
            'title'      => 'contact',
            'type'       => 'object',
            'properties' => []
        ];
    }
}
