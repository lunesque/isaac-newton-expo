<?php
require_once 'config.php';

switch ($request_method) {
    case 'GET':
        if (isset($_GET["account_id"])) {
            if (isset($_COOKIE["account_id"]) && ($_COOKIE["account_id"]==1 || $_COOKIE["account_id"]==$_GET["account_id"])) {
                $result = $reservationManager->getAllReservationsByAccount($_GET["account_id"]);
            } else $result = array(
                'status' => 0,
                'status_message' => 'Error : Not authorised to access this ressource.'
            );
        } else if (isset($_GET["id"])) {
            $result = $reservationManager->getOneReservationById($_GET["id"]);
        } else if (isset($_COOKIE["token"]) && $jwt->isValid($_COOKIE["token"]) && $jwt->check($_COOKIE["token"], SECRET) && !$jwt->isExpired($_COOKIE["token"])) {
            $result = $reservationManager->getAllReservations();
        } else $result = array(
            'status' => 0,
            'status_message' => 'Error : Not authorised to access this ressource.'
        );
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'POST':
        if (isset($_POST["account_id"])) {
            $acc = $accountManager->getOneAccountById($_POST["account_id"]);
            if (isset($acc["status"]) && $acc["status"]==0) {
                $_POST["account_id"] = null;
            }
            $reserv = new Reservation(array_slice($_POST,0,7));
        } else $reserv = new Reservation(array_slice($_POST,0,7));
        $tickets = $_POST["tickets"];
        $result = $reservationManager->addReservation($reserv, $tickets);
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'PUT':
        $input = (array) json_decode(file_get_contents('php://input', TRUE));
        $result = $reservationManager->modifyReservation($_GET["id"], $input);
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'DELETE':
        $result = $reservationManager->deleteReservation($_GET["id"]);
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;
    default:
        
        break;
}





?>