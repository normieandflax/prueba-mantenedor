<?php
class SuccessMessages {
    const PRUEBA = "b704f2afc571e2c27eee20db0910c4a6";
    const SUCCESS_REGISTER_NEWUSER = "3b31870eeb28da2df43515d2056338eb";

    private $success_list = [];

    public function __construct() {
        $this->success_list = [
            SuccessMessages::PRUEBA => "Mensaje de Prueba",
            SuccessMessages::SUCCESS_REGISTER_NEWUSER => "El usuario ingresado ha sido registrado correctamente"
        ];
    }

    public function get($hash) {
        return $this->success_list[$hash];
    }

    public function existsKey($key) {
        if(array_key_exists($key, $this->success_list)) {
            return true;
        }
        else {
            return false;
        }
    }
}