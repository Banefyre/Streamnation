<?php
require_once('RESTClient.php');
session_start();

//if (isset($_POST['login']) && isset($_POST['password'])){
    $rest_client = new RESTClient;

    $data = [
        'identity' => $_POST['login'],
        'password' => $_POST['password']
    ];

    /**
    * Querying server (POST)
    */
    $json = $rest_client->post('api/v1/auth', $data);
    $array = json_decode($json, true);
    var_dump($array);

    $_SESSION['auth_token'] = $array['auth_token'];

 
//}
?>
