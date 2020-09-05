<?php

use app\lib\Request;
use app\lib\Router;
use app\lib\SessionManager;
use app\lib\Messenger;

$session = new SessionManager();
$session->start();
$messenger = new Messenger($session);
$request = new Request();
$router = new router($request, $session, $messenger);
$router->post('/about/test', function () {
    echo 'about function work';
});
//$router->get('/login', 'Users@login');
//$router->any('/register', 'Users@register');
//$router->get('/profile', 'Users@profile');

//$router->get('/auth/login', 'auth@login');
$router->get('/auth/login', function() {
    echo 'test';
});
$router->get('/auth/github', 'Auth@github');
$router->get('/auth/callback', 'Auth@callback');
$router->get('/auth', function() {
    if(class_exists('app\controllers\Auth'))
        echo 'class exits';

});
// return not found page if the router not exit
if (!$router->dispatch()) {
    http_response_code(404);
    require VIEWS_PATH . DS . 'notfound' . DS . 'notfound.view.php';
}

