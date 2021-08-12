<?php
class Errors extends Controller {
    function __construct() {
        parent::__construct();
        error_log('controllers -> errors');
    }

    function render() {
        $this->view->render('errors/index');
    }
}