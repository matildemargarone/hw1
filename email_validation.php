<?php
    header('Content-Type: application/json');

    $key= "secret";
    $endpoint= "https://emailvalidation.abstractapi.com/v1/";

    if(!isset($_GET['email'])){
        echo json_encode(['error' => 'Email non fornita']);
        exit;
    }

    $email= $_GET['email'];
    $url= "{$endpoint}?api_key={$key}&email={$email}";

    $curl= curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result= curl_exec($curl);

    if(curl_errno($curl)){
        echo json_encode(['error' => curl_error($curl)]);
    } else {
        echo $result;
    }

    curl_close($curl);
?>