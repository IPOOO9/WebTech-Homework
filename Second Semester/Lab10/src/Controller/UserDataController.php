<?php

namespace root\app6\Controller;

use root\app6\Model\Entity\User;
use root\app6\Repository\UserRepository;

class UserDataController
{
    private const USER_COOKIE = 'not_user_data';
    private const SALT = '534ewfuib478o23ef';

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(string $login, string $password) {
        $encryptedPass = md5($password . self::SALT);
        $userPass = $this->userRepository->findByName($login)->getPass();
        if ($userPass == $encryptedPass) {
            setcookie(self::USER_COOKIE, $login . ':' . $encryptedPass, mktime(). time()+60*60*24*1, '/');
        }
    }

    public function logout() {
        setcookie(self::USER_COOKIE, null, -1, '/');
    }

    public function reg(string $login, string $password) {
        $encryptedPass = md5($password . self::SALT);
        setcookie(self::USER_COOKIE, $login . ':' . $encryptedPass, mktime(). time()+60*60*24*1, '/');
        $this->userRepository->addUser(new User($login, $encryptedPass));
    }

    public function verify() {
        if ($this->getLogin() != '') {
            $userCookie = $_COOKIE[self::USER_COOKIE];
            $cookie = explode(':', $userCookie);
            $userPass = $this->userRepository->findByName($cookie[0])->getPass();
            $encryptedPass = $cookie[1];
            return $userPass == $encryptedPass;
        }
        else return false;
    }

    public function isAdmin() {
        $userCookie = $_COOKIE[self::USER_COOKIE];
        $cookie = explode(':', $userCookie);
        return $cookie[0] == 'admin';
    }

    public function getLogin() {
        $userCookie = $_COOKIE[self::USER_COOKIE];
        $cookie = explode(':', $userCookie);
        return $cookie[0];
    }
}