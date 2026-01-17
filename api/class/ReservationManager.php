<?php
class ReservationManager {
    private $db;
    
    public function __construct($x){
        $this->db = $x;    
    }
    
    public function getAllReservations() :array
    {
        $requete="select r.*, sum(rt.quantity * t.unit_price) as total,
                max(case when t.title = 'Child' then rt.quantity else 0 end) as child_tickets,
                max(case when t.title = 'Student' then rt.quantity else 0 end) as student_tickets,
                max(case when t.title = 'Adult' then rt.quantity else 0 end) as adult_tickets
                from reservation r
                left join reservation_ticket rt ON r.id = rt.reservation_id
                left join ticket t on rt.ticket_id = t.id
                where r.id = rt.reservation_id
                group by r.id
                order by r.created_at";
        $stmt = $this->db->query($requete);
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function getAllReservationsByAccount($account_id) :array
    {
        $requete="select r.*, sum(rt.quantity * t.unit_price) as total,
                max(case when t.title = 'Child' then rt.quantity else 0 end) as child_tickets,
                max(case when t.title = 'Student' then rt.quantity else 0 end) as student_tickets,
                max(case when t.title = 'Adult' then rt.quantity else 0 end) as adult_tickets
                from reservation r
                left join reservation_ticket rt ON r.id = rt.reservation_id
                left join ticket t on rt.ticket_id = t.id
                where r.account_id=:account_id
                group by r.id
                order by r.created_at";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':account_id', $account_id, PDO::PARAM_INT);
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }
    
    public function getOneReservationById ($id) :array
    {
        $requete="select r.*, sum(rt.quantity * t.unit_price) as total,
                max(case when t.title = 'Child' then rt.quantity else 0 end) as child_tickets,
                max(case when t.title = 'Student' then rt.quantity else 0 end) as student_tickets,
                max(case when t.title = 'Adult' then rt.quantity else 0 end) as adult_tickets
                from reservation r
                left join reservation_ticket rt ON r.id = rt.reservation_id
                left join ticket t on rt.ticket_id = t.id
                where r.id = rt.reservation_id and r.id=:id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $reserv = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($reserv != false) {
            $response = $reserv;
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Error: Reservation not found'
            );
        }
        return $response;
    }

    public function addReservation(Reservation $reserv, array $tickets) :array
    {
        $requete="insert into 
        reservation(id, date, time_slot, account_id, created_at, modified_at, first_name, last_name, email) 
        values(null, :date, :time_slot, :account_id, now(), null, :first_name, :last_name, :email)";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':date', $reserv->getDate('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindValue(':time_slot', $reserv->getTime_slot(), PDO::PARAM_STR);
        $stmt->bindValue(':account_id', $reserv->getAccount_id());
        $stmt->bindValue(':first_name', $reserv->getFirst_name(), PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $reserv->getLast_name(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $reserv->getEmail(), PDO::PARAM_STR);
        if ($stmt->execute()) {
            $response["reservation"] = array(
                'status' => 1,
                'status_message' => 'Reservation added successfully.'
            );
        } else {
            $response["reservation"] = array(
                'status' => 0,
                'status_message' => 'Error: unable to add reservation.'
            );
        }
        foreach ($tickets as $ticket_id => $quantity) {
            if ($quantity > 0) {
                $sub_requete = "INSERT INTO reservation_ticket (reservation_id, ticket_id, quantity) VALUES ((SELECT MAX(id) FROM reservation), :ticket_id, :quantity)";
                $sub_stmt = $this->db->prepare($sub_requete);
                $sub_stmt->bindValue(':ticket_id', $ticket_id, PDO::PARAM_INT);
                $sub_stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
                if ($sub_stmt->execute()) {
                    $response["reservation_ticket"] = array(
                        'status' => 1,
                        'status_message' => 'Reservation ticket added successfully.'
                    );
                } else {
                    $response["reservation_ticket"] = array(
                        'status' => 0,
                        'status_message' => 'Error: unable to add reservation ticket.'
                    );
                }
            }
        }
        return $response;
    }
    
    public function deleteReservation($id) :array
    {
        $requete="delete from reservation where id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $response["reservation"] = array(
                'status' => 1,
                'status_message' => 'Reservation deleted successfully.'
            );
        } else {
            $response["reservation"] = array(
                'status' => 0,
                'status_message' => 'Error.'
            );
        }
        $sub_requete = "delete from reservation_ticket where reservation_id = :reservation_id";
        $sub_stmt = $this->db->prepare($sub_requete);
        $sub_stmt->bindValue(':reservation_id', $id, PDO::PARAM_INT);
        if ($sub_stmt->execute()) {
            $response["reservation_ticket"] = array(
                'status' => 1,
                'status_message' => 'Reservation tickets deleted successfully.'
            );
        } else {
            $response["reservation_ticket"] = array(
                'status' => 0,
                'status_message' => 'Error: unable to delete reservation ticket.'
            );
        }
        return $response;
    }
    

    public function modifyReservation($id, $array) :array
    {
        $requete="update reservation 
        set date = :date, time_slot = :time_slot, modified_at = now()
        where id = :id";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':date', $array["date"], PDO::PARAM_STR);
        $stmt->bindValue(':time_slot', $array["time_slot"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'status_message' => 'Reservation modified successfully.'
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