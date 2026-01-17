<?php
    function loadClass($class) {
        require 'class/'.$class.'.php';
    }
    spl_autoload_register('loadClass');

    $db = new PDO('mysql:host=mysql-isaac-newton.alwaysdata.net;dbname=isaac-newton_expo', '404636', 'MMI@champs');

    const SECRET = 'mmichamps';

    $jwt = new JWT();
    $accountManager = new AccountManager($db);
    $reservationManager = new ReservationManager($db);
    $ticketManager = new TicketManager($db);
    $request_method = $_SERVER["REQUEST_METHOD"];

    header('Content-Type: application/json');
    // header('Access-Control-Allow-Origin: http://localhost:5173');
    $allowed_domains = ['http://localhost:5173', 'http://localhost:5174'];
    if (in_array($_SERVER['HTTP_ORIGIN'], $allowed_domains)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    }
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Credentials: true");

?>