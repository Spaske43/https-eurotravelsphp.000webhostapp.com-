<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');

    $countryID = $_POST['countryID'];

    $checkAnswer = checkIfAnswerExists($_SESSION['user']->id);

    if(!$checkAnswer){
        $answer = addPollAnswer($_SESSION['user']->id, $countryID);

        if ($answer){
            http_response_code(201);
            $response = ['response' => 'Hvala vam sto ste glasali.'];
            echo json_encode($response);
        }else{
            http_response_code(500);
            $response = ['response' => 'Doslo je do
             greske u bazi. Pokusajte kasnije.'];
            echo json_encode($response);
        }

    }else{
        http_response_code(200);
        $response = ['response' => 'Vec ste glasali.'];
        echo json_encode($response);
    }

}else{
    http_response_code(404);
}
?>