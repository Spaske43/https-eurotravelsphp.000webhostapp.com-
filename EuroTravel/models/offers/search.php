<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include('../../config/connection.php');
    include('../functions.php');

    $keyword = $_GET['keyword'];

    $result = searchOffers($keyword);

    http_response_code(200);
    echo json_encode($result);

}else{
    http_response_code(404);
}
?>