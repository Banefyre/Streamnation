<?php
session_start();
require_once('RESTClient.php');

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
    if (array_key_exists('auth_token', $array))
    {
      $_SESSION['auth_email'] = $array['user']['email'];
      $_SESSION['auth_username'] = $array['user']['username'];
      $_SESSION['auth_token'] = $array['auth_token'];
      $_SESSION['auth_id'] = $array['user']['id'];
    }
    echo $json;

//}
?>
