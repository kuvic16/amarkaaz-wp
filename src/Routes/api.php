<?php

$router->url_prefix('amar_kaaz');
$router->get('dashboard', 'HomeController@dashboard');

$router->get('repeatkaaz/init', 'RepeatKaazController@init');
$router->get('repeatkaaz', 'RepeatKaazController@update');
$router->post('repeatkaaz', 'RepeatKaazController@store');
