<?php

use app\lib\Request;
use app\lib\Router;
use app\lib\SessionManager;
use app\lib\Messenger;

$session = new SessionManager();
$session->start();
$session->test ='test';
echo $session->access_token;
$messenger = new Messenger($session);
$request = new Request();
$router = new router($request, $session, $messenger);

$router->get('/auth/login', 'Auth@login');
$router->get('/auth/github', 'Auth@github');
$router->get('/auth/callback', 'Auth@callback');

// return not found page if the router not exit
if (!$router->dispatch()) {
    http_response_code(404);
    require VIEWS_PATH . DS . 'notfound' . DS . 'notfound.view.php';
}

