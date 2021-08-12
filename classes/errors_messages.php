<?php
class ErrorsMessages {
    const ERROR_ADMIN_NEWCATEGORY_EXISTS = "5a03df0d05af907ec2d65d440b601f12";
    const ERROR_SIGNUP_NEWUSER_POST = "7012be63056b282aec05933a9ad6aa18";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "7e56ccb2d584d2dd211c32c6e36aee87";
    const ERROR_SIGNUP_NEWUSER_EXISTS = "8dbd49cb1821ddde6e4033fd5319247e";
    const ERROR_SIGNIN_USER_EMPTY = "7e56ccb2d584d2dd211c32c6e36aee87";
    const ERROR_SIGNIN_USER_AUTH = "2a21e12b0370e3814c965f8de725c668";
    const ERROR_SIGNIN_USER_VALID = "7012be63056b282aec05933a9ad6aa19";

    private $errors_list = [];

    public function __construct() {
        $this->errors_list = [
            ErrorsMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS => "La categoria ya existe",
            ErrorsMessages::ERROR_SIGNUP_NEWUSER_POST => "Ocurrió un error al procesar la solicitud",
            ErrorsMessages::ERROR_SIGNUP_NEWUSER_EMPTY => "No ha ingresado el nombre de usuario y/o su contraseña",
            ErrorsMessages::ERROR_SIGNUP_NEWUSER_EXISTS => "El nombre de usuario ya se encuentra registrado",
            ErrorsMessages::ERROR_SIGNIN_USER_EMPTY => "No ha ingresado el nombre de usuario y/o su contraseña",
            ErrorsMessages::ERROR_SIGNIN_USER_AUTH => "Nombre de Usuario y/o contraseña ingresados son incorrectos",
            ErrorsMessages::ERROR_SIGNIN_USER_VALID => "Ocurrió un error al procesar la solicitud"
        ];
    }

    public function get($hash) {
        return $this->errors_list[$hash];
    }

    public function existsKey($key) {
        if(array_key_exists($key, $this->errors_list)) {
            return true;
        }
        else {
            return false;
        }
    }
}