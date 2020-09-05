<?php


namespace app\controllers;


use app\lib\Helper;
use app\lib\Messenger;
use app\lib\SessionManager;

class Auth extends AbstractController
{
    use Helper;

    protected string $authorizeURL = 'https://github.com/login/oauth/authorize';
    protected string $tokenURL = 'https://github.com/login/oauth/access_token';
    protected string $apiURL = 'https://api.github.com/';

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

    public function login()
    {
        $this->view('auth@login', ['css/all.min.css', 'css/buttons.css']);
    }

    public function github()
    {
        $this->session->foodPrint = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
        $params = array(
            'client_id' => OAUTH_CLIENT_ID,
            'redirect_uri' => 'https://' . $_SERVER['SERVER_NAME'] . '/auth/github',
            'scope' => 'user',
            'state' => $this->session->foodPrint
        );
        $this->redirect($this->authorizeURL . '?' . http_build_query($params));
    }

    public function callback()
    {
        if(isset($_GET['code'])){
            echo $_GET['code'];
        }

    }
}