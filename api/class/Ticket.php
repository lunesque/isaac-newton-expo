<?php
class Ticket {
    private $id;
    private $title;
    private $description;
    private $unit_price;

    //getters
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getUnit_price() {
        return $this->unit_price;
    }


    //setters
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setTimeSlot($description) {
        $this->description = $description;
    }
    public function setUnit_price($unit_price) {
        $this->unit_price = $unit_price;
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