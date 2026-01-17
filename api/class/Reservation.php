<?php
class Reservation {
    private $id;
    private $date;
    private $time_slot;
    private $created_at;
    private $modified_at;
    private $account_id;
    private $first_name;
    private $last_name;
    private $email;

    //getters
    public function getId() {
        return $this->id;
    }
    public function getDate($format = false, $empty_str = ""){ 
        if (!$this->date) {
            return $empty_str;
        }
    
        $dt = new DateTime($this->date);
        return ($format) ? $dt->format($format) : $dt;
    }
    public function getTime_slot() {
        return $this->time_slot;
    }
    public function getCreated_at($format = false, $empty_str = "") {
        if (!$this->created_at) {
            return $empty_str;
        }
    
        $dt = new DateTime($this->created_at);
        return ($format) ? $dt->format($format) : $dt;
    }
    public function getModified_at($format = false) {
        if (!$this->modified_at) {
            return null;
        }
    
        $dt = new DateTime($this->modified_at);
        return ($format) ? $dt->format($format) : $dt;
    }
    public function getAccount_id() {
        return $this->account_id;
    }
    public function getFirst_name() {
        return $this->first_name;
    }
    public function getLast_name() {
        return $this->last_name;
    }
    public function getEmail() {
        return $this->email;
    }

    //setters
    public function setDate($date) {
        $this->date = $date;
    }
    public function setTime_slot($time_slot) {
        $this->time_slot = $time_slot;
    }
    public function setCreated_at($created_at) {
        $this->created_at = new DateTime();
    }
    public function setModified_at() {
        $this->modified_at = null;
    }
    public function setAccount_id($account_id) {
        $this->account_id = $account_id;
    }
    public function setFirst_name($first_name = null) {
        $this->first_name = $first_name;
    }
    public function setLast_name($last_name) {
        $this->last_name = $last_name;
    }
    public function setEmail($email) {
        $this->email = $email;
    }


    //hydrate
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