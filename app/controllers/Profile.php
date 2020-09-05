<?php


namespace app\controllers;


use app\lib\Messenger;
use app\lib\SessionManager;

class Profile extends AbstractController
{
    /**
     * Auth constructor.
     * @param SessionManager $session
     * @param Messenger $messenger
     * @param string $method
     */
    public function __construct(SessionManager $session, Messenger $messenger, string $method)
    {
        $this->session = $session;
        $this->messenger = $messenger;
        $this->_method = $method;
    }

    public function profile() {
        $this->view('profile@profile');
    }

}