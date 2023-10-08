<?php
    session_start();
    if(isset($_POST['btnLogin'])){
        include "../config/connection.php";
        include "functions.php";

        try{
            $email = $_POST['tbEmail'];
            $lozinka = $_POST['tbLozinka'];

            // provera

            $sifrovanaLozinka = md5($lozinka);
            $rezLogovanja = dohvatiKorisnika($email, $sifrovanaLozinka);
            var_dump($rezLogovanja);
            if($rezLogovanja){
                $_SESSION['korisnik'] = $rezLogovanja;

                if($rezLogovanja->naziv == "admin"){
                    header("Location: ../index.php?page=admin");
                }
                else{
                    header("Location: ../index.php?page=korisnik");
                }
            }
            else{
                http_response_code(404);
                header("Location:". $_SERVER['HTTP_REFERER']."?msg=Korisnik ne postoji");
            }
        }
        catch(PDOException $exception){
            http_response_code(500);
            echo $exception->getMessage();
        }
        
    }
    else{
        header('Location: ../index.php');
    }
?>