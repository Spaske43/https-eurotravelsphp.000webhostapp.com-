<?php
    header("Content-type:application/json");
    if($_SERVER['REQUEST_METHOD']=='POST'){
              include "../config/connection.php";
              include "functions.php";

              try{
               $limit=$_POST['limit'];
               $proizvodi=prikaziProizvode($limit);

                foreach ($proizvodi as $p){
                    $cenaObj=vratiPoslednjuCenu($p->id_proizvod);

                    $vrednost=$cenaObj->cena;
                    $p->cena=$vrednost;
                    
                }
               echo json_encode($proizvodi);
               http_response_code(200);

              }catch(PDOException $exception){
                http_response_code(500);
              }
    }else{
        http_response_code(404);
    }
?>