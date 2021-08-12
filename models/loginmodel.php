<?php
class LoginModel extends Model {
    public function __construct(){
        parent::__construct();
    }

    function login($username, $password) {
        try {
            $query = $this->prepare('SELECT * FROM usuarios WHERE username = :username');
            $query->execute([
                'username' => $username
            ]);

            if($query->rowCount() == 1) {
                $item = $query->fetch(PDO::FETCH_ASSOC);

                $user = new UserModel();
                $user->from($item);

                if(password_verify($password, $user->getPassword())) {
                    error_log('LOGINMODEL::LOGIN, SUCCESS');
                    return $user;
                }
                else {
                    error_log('LOGINMODEL::LOGIN, PASS INCORRECTA');
                    return NULL;
                }
            }
        }
        catch(PDOException $ex) {
            echo $ex;
            return NULL;
        }
    }
}