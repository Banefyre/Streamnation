<?php
if (isset($_POST['login']) && isset($_POST['password']))
    /**
    * Including library
    */
    include_once('RESTClient.php');

    /**
    * Instanciating
    */
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
?>
