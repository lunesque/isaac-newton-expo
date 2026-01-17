<?php
class Account {
    private $id;
    private $login;
    private $password;
    private $last_name;
    private $first_name;
    private $email;

    //getters
    public function getId() {
        return $this->id;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getLast_name() {
        return $this->last_name;
    }
    public function getFirst_name() {
        return $this->first_name;
    }
    public function getEmail() {
        return $this->email;
    }


    //setters
    public function setLogin($login) {
        $this->login = $login;
    }
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function setFirst_name($firstName) {
        $this->first_name = $firstName;
    }
    public function setLast_name($lastName) {
        $this->last_name = $lastName;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    // public function __construct($login, $password) {
    //     $this->setLogin($login);
    //     $this->setPassword($password);
    // }

    private function hydrate(array $data){
        foreach ($data as $key => $value) {
        $method = 'set'.ucfirst($key);      
        if (method_exists($this, $method))   {
            $this->$method($value);
            }
        }
    }

    public function __construct(array $data) {
        $this->hydrate($data);
    }


}
?>