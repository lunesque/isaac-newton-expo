<?php
require_once 'config.php';

switch ($request_method) {
    case 'GET':
        if (isset($_GET["id"])) {
            $result = $ticketManager->getOneTicketById($_GET["id"]);
        } 
        else if (isset($_COOKIE["token"])) {
            if (!$jwt->isValid($_COOKIE["token"])) $result = ["invalid cookie"];
            else if (!$jwt->check($_COOKIE["token"], SECRET)) $result = ["wrong secret code"];
            else if ($jwt->isExpired($_COOKIE["token"])) $result = ["expired token"];
            else $result = $ticketManager->getAllTickets();
        
        } else $result = array(
            'status' => 0,
            'status_message' => 'Error : Not authorised to access this ressource.'
        );
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'POST':
        $response = array(
            'status' => 0,
            'status_message' => 'Error : Invalid method.'
        );
        echo json_encode($response);

    case 'PUT':
        $response = array(
            'status' => 0,
            'status_message' => 'Error : Invalid method.'
        );
        echo json_encode($response);
        break;

    case 'DELETE':
        $response = array(
            'status' => 0,
            'status_message' => 'Error : Invalid method.'
        );
        echo json_encode($response);
        break;

}



?>