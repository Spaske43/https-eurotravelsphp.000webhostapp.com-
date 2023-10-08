<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $resID = $_GET['id'];

        $reservation = getReservation($resID);

        if($reservation && isset($_SESSION['user'])
         && ($reservation->id_user == $_SESSION['user']->id
          || $_SESSION['user']->role_name == 'Admin')){

            if(deleteReservation($resID)){
                http_response_code(200);
                $response = ['response' => 'Uspesno brisanje.'];
                if(isset($_GET['admin'])){
                    header("Location: ../../index.php?page=adminReservations");
                }else{
                    header("Location: ../../index.php?page=Rezervacije");
                }
            }else{
                http_response_code(500);
                $response = ['response' => 'Greska u bazi, pokusajte kasnije.'];
                echo json_encode($response);
            }


        }else{
            http_response_code(404);
            $response = ['response' => 'Doslo je do greske.'];
            echo json_encode($response);
        }

    }catch (PDOException $e){
        echo $e;
    }



}else{
    http_response_code(404);
}
?>