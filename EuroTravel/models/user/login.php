<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include($_SERVER["DOCUMENT_ROOT"]."/config/connection.php");
    include('../functions.php');

    try{
        $email = $_POST['email'];
        $password = $_POST['password'];

        $emailReg = '/^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i';
        $passwordReg = '/^(?=.*[a-z])(?=.*\d)[a-z\d]{8,20}$/i';

        $errors = array();

        if(!preg_match($emailReg, $email)){
            array_push($errors, "Neispravna email adresa.");
        }
        if(!preg_match($passwordReg, $password)){
            array_push($errors, "Neispravan format lozinke.");
        }

        if(count($errors) === 0){
            $encryptedPassword = md5($password);

            $user = loginUser($email, $encryptedPassword);

            if($user){
                http_response_code(200);
                $response = ['response' => 'Uspesno logovanje.', 'login' => true];
                $_SESSION['user'] = $user;
                echo json_encode($response);
            }else{
                $response = ['response' => 'Neispravni kredencijali. Pokusajte ponovo.' , 'login' => false];
                echo json_encode($response);
                http_response_code(200);
            }

        }else{
            echo json_encode($errors);
            http_response_code(400);
        }

    }catch(PDOException $ex){
        echo $ex;
    }
}else{
    http_response_code(400);
    return;
}
?>