<?php
require_once 'classes/session_users.php';
require_once 'models/usermodel.php';

class SessionsController extends Controller {
    private $user_session;
    private $username;
    private $password;
    private $session;
    private $sites;
    private $user;

    function __construct() {
        parent::__construct();

        $this->init();
    }

    function init() {
        $this->session = new SessionUsers();

        $json = $this->getJSONFileConfig();

        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];

        $this->validateSession();
    }

    private function getJSONFileConfig() {
        $string = file_get_contents('config/access.json');
        $json = json_decode($string, true);

        return $json;
    }

    function validateSession() {
        error_log('classes -> session_controller -> validateSession');

        if($this->existsSession()){
            $type = $this->getUserSessionData()->getType();

            if($this->isPublic()) {
                $this->redirectDefaultSiteByType($type);
            }
            else {
                if($this->isAuthorized($type)) {

                }
                else {
                    $this->redirectDefaultSiteByType($type);
                }
            }
        }
        else {
            if($this->isPublic()) {

            }
            else {
                header('Location: '.constant('URL').'');
            }
        }
    }

    function existsSession(){
        if(!$this->session->exists()) {
            return false;
        }

        if($this->session->getCurrentUser() == NULL) {
            return false;
        }

        $userid = $this->session->getCurrentUser();

        if($userid) { 
            return true;
        }

        return false;
    }

    function getUserSessionData() {
        $id = $this->session->getCurrentUser();
        $this->user = new UserModel();
        $this->user->get($id);
        error_log("sessionController::getUserSessionData(): ".$this->user->getUsername());
        return $this->user;
    }

    public function initialize($user) {
        error_log("sessionController::initialize(): user: ".$user->getUsername());
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRole());
    }

    private function isPublic() {
        $currentURL = $this->getCurrentPage();
        
        error_log("sessionController::isPublic(): currentURL => ".$currentURL);
        
        $currentURL = preg_replace( "/\?.*/", "", $currentURL);
        
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public') {
                return true;
            }
        }
        
        return false;
    }

    private function redirectDefaultSiteByType($type) {
        $url = '';
        
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($this->sites[$i]['type'] === $type){
                $url = '/prueba/'.$this->sites[$i]['site'];
                break;
            }
        }
        
        header('Location: '.$url);
        
    }

    private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
        
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
                return true;
            }
        }
        return false;
    }

    private function getCurrentPage(){
        
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        error_log("sessionController::getCurrentPage(): actualLink =>".$actual_link.", url => ".$url[2]);
        return $url[2];
    }

    function authorizeAccess($role){
        error_log("sessionController::authorizeAccess(): role: $type");
        switch($role){
            case '1':
                $this->redirect($this->defaultSites['1']);
            break;
            
            case '2':
                $this->redirect($this->defaultSites['2']);
            break;
            
            default:
        }
    }

    function logout(){
        $this->session->closeSession();
    }
}