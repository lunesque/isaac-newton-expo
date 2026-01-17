<?php

class AccountManager {

    private $db;
    
    public function __construct($x){
        $this->db = $x;    
    }
    
    //GET
    public function getAllAccounts() :array
    {
        $accounts = [];
        $requete="select * FROM account";
        $stmt = $this->db->query($requete);
        while ($acc = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($accounts, $acc);
            }
        return $accounts;
    }
    public function getOneAccountById ($id) :array
    {
        $requete="select * FROM account WHERE id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $acc = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($acc != false) {
            $response = $acc;
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error: Account not found'
            );
        }
        return $response;
    }

    //POST
    public function addAccount(Account $acc) :array
    {
        $requete="insert into account(id, login, password, first_name, last_name, email) values(null, :login, :password, :first_name, :last_name, :email)";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':login', $acc->getLogin(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $acc->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $acc->getFirst_name(), PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $acc->getLast_name(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $acc->getEmail(), PDO::PARAM_STR);
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'status_message' => 'Account added successfully.',
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error.'
            );
        }
        return $response;
    }
    
    //DELETE
    public function deleteAccount($id) :array
    {
        $requete="delete from account where id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'status_message' => 'Account deleted successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error.'
            );
        }
        return $response;
    }
    
    //PUT
    public function modifyAccount($id, $array) :array
    {
        $requete="update account set login = :login, password = :password, first_name = :first_name, last_name = :last_name, email = :email where id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':login', $array['login'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $array['password'], PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $array['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $array['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $array['email'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'status_message' => 'Account modified successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error.'
            );
        }
        return $response;
    }

    //LOGIN
    public function verifyLogin($login, $password) {
        $requete = "SELECT id,login, password FROM account WHERE login=:login";
        $stmt = $this->db->prepare($requete);
        if (isset($login)) {
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        }
        $stmt->execute();

        if ($acc=$stmt->fetch()) {
            if (password_verify($password, $acc["password"])) {
                $response = array(
                    'status' => 1,
                    'status_message' => 'Logged in successfully.',
                    'account_id' => $acc["id"]
                );
            }
            else {
                $response = array(
                    'status' => 0,
                    'status_message' => 'Error : Incorrect password.'
                );
            }
        }
        else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error : Incorrect login.'
            );
        }
        return $response;
    }

}


    

?>