<?php
header("Content-type: application/json");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $name = $_POST['name'];
        $countryID = $_POST['countryID'];
        $location = $_POST['location'];
        $image_url = $_POST['image_url'];
        $price = $_POST['price'];
        $length = $_POST['length'];
        $description = $_POST['description'];
        $id = $_POST['id'];

        $offer = updateOffer($id,$name, $countryID,
         $location, $image_url, $price, $length, $description);

        if($offer){
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