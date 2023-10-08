<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $id = $_POST['id'];
        $country_name = $_POST['country_name'];
        $flag_url = $_POST['flag_url'];

        $country = updateCountry($id, $country_name, $flag_url);

        if($country){
            http_response_code(200);
            $response = ['response' => 'Uspesna izmena!'];
            echo json_encode($response);
        }else{
            http_response_code(500);
            $response = ['response' => 'Nastala je greska. Pokusajte kasnije.'];
            echo json_encode($response);
        }

    }catch (PDOException $e){
        echo $e;
    }

}else{
    http_response_code(404);
}
?>