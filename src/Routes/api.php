<?php

$router->url_prefix('amar_kaaz');
$router->get('dashboard', 'HomeController@dashboard');

$router->get('repeatkaaz', 'RepeatKaazController@update');
$router->get('repeatkaaz1', 'RepeatKaazController@store');
