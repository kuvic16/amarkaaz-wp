<?php

$router->url_prefix('amar_kaaz');
$router->get('dashboard', 'HomeController@dashboard');

$router->get('repeatkaaz', 'RepeatKaazController@repeatkaaz');
