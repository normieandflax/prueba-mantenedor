<?php
class UserModel extends Model implements InterfaceModel {
    private $id;
    private $username;
    private $password;
    private $type;

    public function __construct() {
        parent::__construct();
        $this->username = '';
        $this->password = '';
        $this->type = 0;
    }

    public function save() {
        try {
            $query = $this->prepare('INSERT INTO usuarios(username, password, type) VALUES (:username, :password, :type)');
            $query->execute([
                'username' => $this->username,
                'password' => $this->password,
                'type' => $this->type
            ]);

            return true;
        }
        catch(PDOException $ex) {
            error_log('models -> usermodel -> save '.$ex);
            return false;
        }
    } 

    public function getAll() {
        $users_list = [];

        try {
            $query = $this->query('SELECT * FROM usuarios');

            while($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new UserModel();
                $user->setId($result['id']);
                $user->setUsername($result['username']);
                $user->setPassword($result['password']);
                $user->setType($result['type']);

                array_push($users_list, $user);
            }

            return $users_list;
        }
        catch(PDOException $ex) {
            error_log('models -> usermodel -> getAll '.$ex);
        }
    }

    public function get($id) {
        try {
            $query = $this->query('SELECT * FROM usuarios WHERE id = :id');
            
            $query->execute([
                'id' => $id
            ]);

            $user = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->setId($user['id']);
            $this->setUsername($user['username']);
            $this->setPassword($user['password']);
            $this->setType($user['type']);

            return $this;
        }
        catch(PDOException $ex) {
            error_log('models -> usermodel -> get '.$ex);
        }
    }

    public function delete($id) {
        try {
            $query = $this->query('DELETE FROM usuarios WHERE id = :id');
            
            $query->execute([
                'id' => $id
            ]);

            return true;
        }
        catch(PDOException $ex) {
            error_log('models -> usermodel -> delete  '.$ex);
            return false;
        }
    }

    public function update() {
        try {
            $query = $this->query('UPDATE usuarios SET username = :username, password = :password, type = :type WHERE id = :id');
            
            $query->execute([
                'id' => $id,
                'username' => $this->username,
                'password' => $this->password,
                'type' => $this->type
            ]);

            $user = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->setId($user['id']);
            $this->setUsername($user['username']);
            $this->setPassword($user['password']);
            $this->setType($user['type']);

            return true;
        }
        catch(PDOException $ex) {
            error_log('models -> usermodel -> update '.$ex);
            return false;
        }
    }

    public function from($array) {
        $this->setId($array['id']);
        $this->setUsername($array['username']);
        $this->setPassword($array['password']);
        $this->setType($array['type']);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) { 
        $this->username = $username;
    }

    public function setPassword($password, $hash = true) { 
        if($hash) {
            $this->password = $this->getHashedPassword($password);
        }
        else {
            $this->password = $password;
        }
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getType() {
        return $this->type;
    }

    private function getHashedPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function exists($username) {
        try {
            $query = $this->prepare('SELECT username FROM usuarios WHERE username = :username');
            $query->execute([
                'username' => $username
            ]);
            
            if($query->rowCount() > 0) {
                return true;
            }
            else {
                return false;
            }
        }
        catch(PDOException $ex) {
            error_log('models -> usermodel -> exists '.$ex);
            return false;
        }
    }

    public function comparePasswords($password, $id) {
        try {
            $user = $this->get($id);
            return password_verify($password, $user->getPassword());
        }
        catch(PDOException $ex) {
            error_log('models -> usermodel -> comparePasswords '.$ex);
            return false;
        }
    }
}