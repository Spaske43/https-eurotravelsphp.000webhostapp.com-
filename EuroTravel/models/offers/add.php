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
        $date = $_POST['date'];
        $desc = $_POST['desc'];

        $offerID = addOffer($name, $countryID, $location, $image_url, $price, $length, $desc);

        if($offerID){

            $startDate = addStartDate($offerID->id, $date);

            if($startDate){
                http_response_code(201);
                $response = ['response' => 'Ponuda dodata.', "success" => true];
                echo json_encode($response);
            }else{
                http_response_code(500);
                $response = ['response' => 'Greska u bazi. Pokusajte kasnije.'];
                echo json_encode($response);
            }

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