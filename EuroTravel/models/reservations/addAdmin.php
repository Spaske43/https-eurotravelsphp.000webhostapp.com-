<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $dateID = $_POST['dateID'];
        $peopleNum = $_POST['people'];
        $offerID = $_POST['offerID'];
        $userID = $_POST['userID'];

        $resCheck = checkIfReservationExists($offerID, $userID, $dateID);

        if(!$resCheck){
            $reservation = addReservation($offerID, $userID, $peopleNum, $dateID);

            if($reservation){
                http_response_code(200);
                $response = ['response' => 'Uspeh' , 'success' => true];
                echo json_encode($response);
            }else{
                http_response_code(500);
                $response = ['response' => 'Nastala je greska. Pokusajte kasnije.' , 'success' => false];
                echo json_encode($response);
            }

        }else{
            http_response_code(200);
            $response = ['response' => 'Ista rezervacija vec postoji.', 'success' => false];
            echo json_encode($response);
        }

    }catch (PDOException $e){
        echo $e;
    }



}else{
    http_response_code(404);
}
?>