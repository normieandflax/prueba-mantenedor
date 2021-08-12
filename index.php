<?php
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set("error_log", "C:/xampp/htdocs/prueba/php-error.log"); //CONFIGURAR A CARPETA EN DONDE SE EJECUTARÁ LOCALMENTE EL SISTEMA
error_log(" ---- Lista de Errores ----");

require_once 'libs/app.php';
require_once 'libs/controller.php';
require_once 'libs/database.php';
require_once 'libs/model.php';
require_once 'libs/view.php';

require_once 'classes/errors_messages.php';
require_once 'classes/success_messages.php';
require_once 'classes/sessions_controller.php';

require_once 'config/config.php';

$app = new App();