<?php
session_start();
require_once('RESTClient.php');

$rest_client = new RESTClient;

$data = [
    'auth_token' => $_SESSION['auth_token'],
];

$json = $rest_client->delete('api/v1/auth', $data);
session_unset();
session_destroy();
header('Location: ./');
?>
