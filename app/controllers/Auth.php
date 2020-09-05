<?php


namespace app\controllers;


use app\lib\API;
use app\lib\Helper;
use app\lib\InputFilter;
use app\lib\Messenger;
use app\lib\SessionManager;
use app\models\UsersModel;

class Auth extends AbstractController
{
    use Helper;
    use InputFilter;

    protected string $authorizeURL = 'https://github.com/login/oauth/authorize';
    protected string $tokenURL = 'https://github.com/login/oauth/access_token';
    protected string $apiURL = 'https://api.github.com/user';

    /**
     * Auth constructor.
     * @param SessionManager $session
     * @param Messenger $messenger
     * @param string $method
     */
    public function __construct(SessionManager $session, Messenger $messenger, string $controller, string $method)
    {
        $this->session = $session;
        $this->messenger = $messenger;
        $this->_method = $method;
        $this->_controller = $controller;
    }

    public function login()
    {

        if (isset($this->session->user))
            $this->redirect('/profile');
        if (isset($_POST['login'])) {
            var_dump($_POST);
            if (UsersModel::authenticate($this->filterString($_POST['user']), $_POST['password'], $this->session)) {
                $this->redirect('/profile');
            }
        }
        $this->view('auth@login', ['css/all.min.css', 'css/buttons.css']);
    }

    public function github()
    {
        if (isset($this->session->user))
            $this->redirect('/profile');
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
        if (isset($this->session->user))
            $this->redirect('/profile');
        if (!isset($_GET['code']) || !isset($this->session->foodPrint))
            $this->redirect('/auth/login');

        $this->session->code = $_GET['code'];
        $params = [
            'client_id' => OAUTH_CLIENT_ID,
            'client_secret' => OAUTH_CLIENT_SECRET,
            'redirect_uri' => 'https://' . $_SERVER['SERVER_NAME'] . '/auth/callback',
            'scope' => 'user',
            'state' => $this->session->foodPrint,
            'code' => $this->session->code
        ];
        $response = API::sendRequest($this->tokenURL, $this->session, $params);
        $this->session->access_token = $response->access_token;
        $this->redirect('/auth/password');
    }

    public function password()
    {
        if (isset($this->session->user))
            $this->redirect('/profile');
        if (!isset($this->session->access_token) && !isset($this->session->foodPrint))
            $this->redirect('/auth/login');
        if (!isset($this->session->dataGitHub)) {
            $response = API::sendRequest($this->apiURL, $this->session);
            if (UsersModel::userExisting($response->login)) {
                $user = UsersModel::getByPK($response->login);
                $this->session->user = $user;
                $this->redirect('/profile');
            }
            $this->session->dataGitHub = $response;
        }
        if (isset($_POST['setPassword']) && UsersModel::confirmPassword($_POST['password'], $_POST['confirmPassword'])) {
            $user = new UsersModel();
            $user->user = $this->session->dataGitHub->login;
            $user->email = $this->session->dataGitHub->email;
            $user->name = $this->session->dataGitHub->name;
            $user->cryptPassword($_POST['password']);
            if ($user->save(false)) {
                $this->session->user = $user;
                $this->messenger->add('user register successfully');
                $this->redirect('/profile');
            } else {
                $this->messenger->add('user not save', Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->view('auth@password');
    }
    public function logout() {
        unset($this->session->user);
        unset($this->session->dataGitHub);
        unset($this->session->code);
        unset($this->session->access_token);
        $this->redirect('/auth/login');
    }
}