<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../../config/connection.php');
    include('../functions.php');

    try{
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $roleID = $_POST['roleID'];
        $userID = $_POST['userID'];

//        PROVERA EMAIL ADRESE
        $emailCheck = checkEmailExistsAdmin($email,$userID);
        if($emailCheck){
            $response = ['response' => 'Korisnik sa ovom email adresom vec postoji.'];
            echo json_encode($response);
            http_response_code(200);
            return;
        }

//        PROVERA UNETIH PODATAKA
        $usernameReg = '/^[a-z][a-z0-9]{5,16}$/i';
        $emailReg = '/^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i';
        $phoneReg = '/^[0][6][0-9]{7,12}$/';

        $errors = array();

        if(!preg_match($usernameReg, $username)){
            array_push($errors, "Neispravno korisnicko ime.");
        }
        if(!preg_match($emailReg, $email)){
            array_push($errors, "Neispravna email adresa.");
        }
        if(!preg_match($phoneReg, $phone)){
            array_push($errors, "Neispravan format telefona.");
        }
        if($roleID == 0){
            array_push($errors, "Nije izabrana uloga.");
        }

        if(count($errors) == 0){

            $user = editUser($userID,$username, $email, $phone, $roleID);

            if($user){
                $response = ['response' => 'Uspesna izmena.'];
                echo json_encode($response);
                http_response_code(200);

            }else{
                $response = ['response' => 'Doslo je do greske u bazi, pokusajte opet kasnije.'];
                echo json_encode($response);
                http_response_code(500);
            }
        }else{
            echo json_encode($errors);
        }


    }catch (PDOException $e){
        echo $e;
    }



}else{
    http_response_code(404);
}
?>