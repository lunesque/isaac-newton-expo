<?php
class TicketManager {
    private $db;
    
    public function __construct($x){
        $this->db = $x;    
    }
    
    public function getAllTickets() :array
    {
        $tickets = [];
        $requete="select * FROM ticket";
        $stmt = $this->db->query($requete);
        while ($tick = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($tickets, $tick);
            }
        return $tickets;
    }
    
    public function getOneTicketById ($id) :array
    {
        $requete="select * FROM ticket WHERE id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $tick = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($tick != false) {
            $response = $tick;
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error: Ticket not found'
            );
        }
        return $response;
    }

    public function addTicket(Ticket $tick) :array
    {
        $requete="insert into 
        ticket(id, title, description, unit_price) 
        values(null, :title, :description, :unit_price)";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':title', $tick->getLabel, PDO::PARAM_STR);
        $stmt->bindValue(':description', $tick->getDescription, PDO::PARAM_STR);
        $stmt->bindValue(':unit_price', $tick->getUnit_price, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'status_message' => 'Ticket added successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error.'
            );
        }
        return $response;
    }
    
    public function deleteTicket($id) :array
    {
        $requete="delete from ticket where id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'status_message' => 'Ticket deleted successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error.'
            );
        }
        return $response;
    }
    
    public function modifyTicket($id, $array) :array
    {
        $requete="update ticket 
        set title = :title, description = :description
        where id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $array["title"], PDO::PARAM_STR);
        $stmt->bindValue(':description', $array["description"], PDO::PARAM_STR);
        $stmt->bindValue(':unit_price', $array["unit_price"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'status_message' => 'Ticket modified successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error.'
            );
        }
        return $response;
    }
    
}


    

?>