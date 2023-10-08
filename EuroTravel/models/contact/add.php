<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');
    
    try{
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        $errors = array();

        if(!$subject){
            array_push($errors,"Naslov nije ispravan.");
        }
        if(!$body){
            array_push($errors,"Telo poruke nije ispravno.");
        }

        if(count($errors) == 0){
            $message = addMessage($_SESSION['user']->id, $subject, $body);

            if($message){
                http_response_code(201);
                $response = ['response' => 'Poruka poslata.'];
                echo json_encode($response);
            }else{
                http_response_code(500);
                $response = ['response' => 'Greska u bazi. Pokusajte kasnije.'];
                echo json_encode($response);
            }
        }else{
            http_response_code(200);
            $response = ['response' => 'Pogresno uneti podaci.'];
            echo json_encode($response);
        }


    }catch (PDOException $e){
        http_response_code(500);
        $response = ['response' => 'Greska u bazi. Pokusajte kasnije.'];
        echo json_encode($response);
    }



}else{
    http_response_code(404);
}
?>