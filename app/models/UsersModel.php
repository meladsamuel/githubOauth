<?php

namespace app\models;

use app\lib\SessionManager;

class UsersModel extends AbstractModel
{
    public string $user;
    public ?string $email;
    public string $password;
    public ?string $name;

    protected static string $tableName = 'users';
    protected static string $primaryKey = 'user';
    protected static array $tableSchema = [
        'user' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'password' => self::DATA_TYPE_STR,
        'name' => self::DATA_TYPE_STR
    ];

    public function cryptPassword($password)
    {
        $this->password = crypt($password, APP_SALT);
    }

    public static function confirmPassword($password, $confirmPassword)
    {
        if ($password === $confirmPassword)
            return true;
        return false;
    }

    public static function getUsers($user)
    {
        return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE user != ' . $user
        );
    }

    public static function userExisting($user)
    {
        return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE user = "' . $user . '"'
        );
    }

    /**
     * @param string $user
     * @param string $password
     * @param SessionManager $session
     * @return bool
     */
    public static function authenticate(string $user, string $password, SessionManager $session)
    {
        $password = crypt($password, APP_SALT);
        $foundUser = self::getOne(
            'SELECT * FROM ' . self::$tableName . ' WHERE user = "' . $user . '" AND ' . 'password = "' . $password . '"'
        );
        if ($foundUser) {
            $session->user = $foundUser;
            return true;
        }
        return false;
    }


}