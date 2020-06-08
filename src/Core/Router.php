<?php

namespace Amar\Kaaz\Core;

use Exception;

/**
 * Router handler class
 */
class Router
{
    /**
     * URL prefix to unique
     * 
     * @var string
     */
    private $url_prefix = "";

    /**
     * Storing all defined routes
     * 
     * @var array
     */
    public $routes = [
        'GET'  => [],
        'POST' => []
    ];

    /**
     * Set url prefix
     * 
     * @param string $prefix
     * 
     * @return void
     */
    public function url_prefix($prefix)
    {
        $this->url_prefix = $prefix;
    }


    /**
     * Load router file
     * 
     * @param string $file
     * 
     * @return Router
     */
    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    /**
     * Set get request uri
     * 
     * @param string $uri
     * @param string $controller
     * 
     * @return void
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Set post request uri
     * 
     * @param string $uri
     * @param string $controller
     * 
     * @return void
     */
    public function post($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Get associative controller based on uri
     * 
     * @return void
     */
    public function direct()
    {
        foreach ($this->routes['GET'] as $uri => $route) {
            $this->callAction(
                $uri,
                ...explode('@', $route)
            );
        }
    }

    /**
     * Set wordpress ajax action
     * 
     * @param string $uri
     * @param string $controller
     * @param string $action
     * 
     * @return void
     */
    protected function callAction($uri, $controller, $action)
    {
        $controller = "Amar\\Kaaz\\App\\Controllers\\{$controller}";
        $controller = new $controller;
        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
        add_action(
            'wp_ajax_' . $this->url_prefix . "_{$uri}",
            [
                $controller,
                $action
            ]
        );
    }
}
