<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $dateID = $_POST['dateID'];
        $people = $_POST['people'];
        $offerID = $_POST['offerID'];
        $userID = $_POST['userID'];
        $id = $_POST['id'];

        $resCheck = checkIfReservationExists($offerID, $userID, $dateID);

        if(!$resCheck){
            $reservation = updateReservation($id, $offerID, $userID, $people, $dateID);

            if($reservation){
                http_response_code(200);
                $response = ['response' => 'Uspesna izmena!'];
                echo json_encode($response);
            }else{
                http_response_code(500);
                $response = ['response' => 'Nastala je greska. Pokusajte kasnije.'];
                echo json_encode($response);
            }

        }else{
            http_response_code(200);
            $response = ['response' => 'Rezervacija sa istim podacima vec postoji.'];
            echo json_encode($response);
        }

    }catch (PDOException $e){
        echo $e;
    }



}else{
    http_response_code(404);
}
?>