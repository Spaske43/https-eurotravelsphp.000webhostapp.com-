<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $offerID = $_POST['offerID'];
        $date = $_POST['date'];

        $date = addStartDate($offerID,$date);

        if($date){
            http_response_code(200);
            $response = ['response' => 'Uspesno dodato.', 'success' => true];
            echo json_encode($response);
        }else{
            http_response_code(500);
            $response = ['response' => 'Greska u bazi. Pokusajte kasnije.'];
            echo json_encode($response);
        }
    }catch(PDOException $e){
        echo $e;
    }

}else{
    http_response_code(404);
}
?>