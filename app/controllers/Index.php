<?php


namespace app\controllers;


use app\lib\Helper;
use app\lib\Messenger;
use app\lib\SessionManager;

class Index extends AbstractController
{
    use Helper;
    public function __construct(SessionManager $session, Messenger $messenger, string $controller, string $method)
    {
        $this->session = $session;
        $this->messenger = $messenger;
        $this->_method = $method;
        $this->_controller = $controller;
    }
    public function default() {
        $this->redirect('/auth/login');
    }
}