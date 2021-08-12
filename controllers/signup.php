<?php
require_once 'models/usermodel.php';

class SignUp extends SessionsController {
    function __construct() {
        parent::__construct();
    }

    function render() {
        $this->view->render('login/signup', []);
    }

    function newUser() {
        if($this->existsPOST(['username', 'password'])) {
            $username = $this->getPost('username');
            $password = $this->getPost('password');

            if($username == '' || empty($username) || $password == '' || empty($password)) {
                $this->redirect('signup', ['error' => ErrorsMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new UserModel();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setType(2);

            if($user->exists($username)) {
                $this->redirect('signup', ['error' => ErrorsMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
            }
            elseif($user->save()) {
                $this->redirect('signup', ['success' => SuccessMessages::SUCCESS_REGISTER_NEWUSER]);
            }
            else {
                $this->redirect('signup', ['error' => ErrorsMessages::ERROR_SIGNUP_NEWUSER_POST]);
            }
        }
        else {
            $this->redirect('signup', ['error' => ErrorsMessages::ERROR_SIGNUP_NEWUSER_POST]);
        }
    }
}