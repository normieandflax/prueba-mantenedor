<?php
class Login extends Controller {
    function __construct(){
        parent::__construct();
        error_log('controllers -> login');
    }

    function render() {
        $this->view->render('login/index');
    }

    function authenticate() {
        if($this->existsPOST(['username', 'password'])) {
            $username = $this->getPost('username');
            $password = $this->getPost('password');

            if($username == '' || empty($username) || $password == '' || empty($password)) {
                $this->redirect('', ['error' => ErrorsMessages::ERROR_SIGNIN_USER_EMPTY]);
            }

            $user = $this->model->login($username, $password);

            if($user !== NULL) {
                $this->initialize($user);
            }
            else {
                $this->redirect('', ['error' => ErrorsMessages::ERROR_SIGNIN_USER_AUTH]);
            }
        }
        else {
            $this->redirect('', ['error' => ErrorsMessages::ERROR_SIGNIN_USER_VALID]);
        }
    }
}