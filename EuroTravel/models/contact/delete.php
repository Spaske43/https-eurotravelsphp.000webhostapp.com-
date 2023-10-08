<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $ID = $_GET['id'];

        $message = getMessage($ID);

        if($message && ($_SESSION['user']->role_name == 'Admin')){

            if(deleteMessage($ID)){
                http_response_code(200);
                $response = ['response' => 'Uspesno brisanje.'];
                header("Location: ../../index.php?page=adminMessages");

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