<?php
require_once 'config.php';

switch ($request_method) {
    case 'GET':
        if (isset($_COOKIE["token"])) {
            if ($jwt->isValid($_COOKIE["token"]) && $jwt->check($_COOKIE["token"], SECRET)) {
                if ($jwt->isExpired($_COOKIE["token"])) {
                    $response = array(
                        'status' => 0,
                        'status_message' => 'Token is expired'
                    );
                } else 
                $response = array(
                    'status' => 1,
                    'status_message' => 'Token is valid'
                );
            } else $response = array(
                'status' => 0,
                'status_message' => 'Invalid token'
            );
        } else $response = array(
            'status' => 0,
            'status_message' => 'No token found'
        );
        echo json_encode($response);
        break;

    case 'POST':
        $_POST = (array) json_decode(file_get_contents('php://input', TRUE));
        $result = $accountManager->verifyLogin($_POST["login"], $_POST["password"]);

        if ($result['status'] == 1) {
            setcookie('account_id', $result['account_id'], ['expires' => time()+3600, 'path' => "/", 'secure' => true, 'httponly' => false, 'samesite' => 'Strict']);
            $response = array(
                'status' => 1,
                'status_message' => 'Logged in successfully.',
                'account_id' => $result['account_id']
            );
            if ($result["account_id"] == 1) { 
                // generate token if logged in as admin
                $acc = $accountManager->getOneAccountById($result["account_id"]);
                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];
                $payload = [
                    'account_id' => $acc["id"],
                    'login' => $acc["login"]
                ];
                //JWT token duration set to 60 minutes
                $token = $jwt->generate($header, $payload, SECRET, 3600);
                setcookie( "token", $token, ['expires' => time()+3600, 'path' => "/", 'secure' => true, 'httponly' => true, 'samesite' => 'Strict']);
            }
        } else $response = array(
            'status' => 0,
            'status_message' => 'Error : Unable to log in.'
        );
        echo json_encode($response);
        break;

    case 'PUT':
        $response = array(
            'status' => 0,
            'status_message' => 'Error : Invalid method.'
        );
        echo json_encode($response);
        break;

    case 'DELETE':
        if (isset($_COOKIE["account_id"])) {
            unset($_COOKIE["account_id"]); 
            setcookie("account_id", "", -1, "/"); 
            $response["account"] = array(
                'status' => 1,
                'status_message' => 'Session destroyed.'
            );
        } else $response["account"] = array(
            'status' => 0,
            'status_message' => 'Error: Account not found'
        );
        if (isset($_COOKIE["token"])) {
            unset($_COOKIE["token"]); 
            setcookie("token", "", -1, "/"); 
            $response["token"] = array(
                'status' => 1,
                'status_message' => 'Token destroyed.'
            );
        } else $response["token"] = array(
            'status' => 0,
            'status_message' => 'Error: Token not found'
        );
        echo json_encode($response);
        break;
}




?>