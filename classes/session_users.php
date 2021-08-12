<?php
class SessionUsers {
    private $session_name = 'user';

    public function __construct() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setCurrentUser($user) {
        $_SESSION[$this->session_name] = $user;
    }

    public function getCurrentUser() {
        return $_SESSION[$this->session_name];
    }

    public function closeSession() {
        session_unset();
        session_destroy();
    }

    public function exists() {
        return isset($_SESSION[$this->session_name]);
    }
}