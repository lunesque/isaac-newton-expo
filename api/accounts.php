<?php
require_once 'config.php';

switch ($request_method) {
    case 'GET':
        if (isset($_GET["id"])) {
            if (isset($_COOKIE["account_id"]) && ($_COOKIE["account_id"]==1 || $_COOKIE["account_id"]==$_GET["id"])) {
                $result = $accountManager->getOneAccountById($_GET["id"]);
            } else $result = array(
                'status' => 0,
                'status_message' => 'Error : Not authorised to access this ressource.'
            );
        } 
        else if (isset($_COOKIE["token"])) {
            if (!$jwt->isValid($_COOKIE["token"])) $result = ["invalid cookie"];
            else if (!$jwt->check($_COOKIE["token"], SECRET)) $result = ["wrong secret code"];
            else if ($jwt->isExpired($_COOKIE["token"])) $result = ["expired token"];
            else $result = $accountManager->getAllAccounts();
        
        } else $result = array(
            'status' => 0,
            'status_message' => 'Error : Not authorised to access this ressource.'
        );
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'POST':
        $acc = new Account($_POST);
        $result = $accountManager->addAccount($acc);
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'PUT':
        $input = (array) json_decode(file_get_contents('php://input', TRUE));
        $result = $accountManager->modifyAccount($_GET["id"], $input);
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'DELETE':
        $result = $accountManager->deleteAccount($_GET["id"]);
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

}



?>