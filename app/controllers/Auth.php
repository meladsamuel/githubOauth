<?php


namespace app\controllers;


use app\lib\API;
use app\lib\Helper;
use app\lib\InputFilter;
use app\lib\Messenger;
use app\lib\SessionManager;

class Auth extends AbstractController
{
    use Helper;
    use InputFilter;

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
        $params = [
            'client_id' => OAUTH_CLIENT_ID,
            'redirect_uri' => 'https://' . $_SERVER['SERVER_NAME'] . '/auth/callback',
            'scope' => 'user',
            'state' => $this->session->foodPrint
        ];
        $this->redirect($this->authorizeURL . '?' . http_build_query($params));
    }

    public function callback()
    {
        if (isset($this->session->access_token)) {
            $user = API::sendRequest($this->apiURL . 'user', $this->session, $params);
            echo '<h3>Logged In</h3>';
            echo '<h4>' . $user->name . '</h4>';
            echo '<pre>';
            print_r($user);
            echo '</pre>';
        }
        if (!isset($_GET['code']) || !isset($this->session->foodPrint))
            $this->redirect('/auth/login');
        $params = [
            'client_id' => OAUTH_CLIENT_ID,
            'redirect_uri' => 'https://' . $_SERVER['SERVER_NAME'] . '/auth/callback',
            'scope' => 'user',
            'state' => $this->session->foodPrint,
            'code' => $_GET['code']
        ];
        $response = API::sendRequest($this->tokenURL, $this->session, $params);
        $this->session->access_token = $response->access_token;
        $this->redirect('auth/callback');


    }
}