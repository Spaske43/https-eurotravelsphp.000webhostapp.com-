<?php
session_start();
    include('views/fixed/head.php');
    include('views/fixed/nav.php');
    include_once("config/connection.php");
?>
<?php

    if(!isset($_GET['page'])){
        include "views/pages/home.php";
    }
    else{
        switch($_GET['page']){
            case 'Ponude':
                include "views/pages/offers.php";
                break;
            case 'Kontakt':
                include "views/pages/contact.php";
                break;
            case "Autor":
                include "views/pages/author.php";
                break;
            case "login":
                include "views/pages/login.php";
                break;
            case "register":
                include "views/pages/register.php";
                break;
            case "Rezervacije":
                include "views/pages/reservations.php";
                break;
            case "ponuda":
                include "views/pages/offer.php";
                break;
            case "adminReservations":
                include "views/pages/adminReservations.php";
                break;
            case "editReservation":
                include "views/pages/editReservation.php";
                break;
            case "Države":
                include "views/pages/adminCountries.php";
                break;
            case "Korisnici":
                include "views/pages/adminUsers.php";
                break;
            case "Poruke":
                include "views/pages/adminMessages.php";
                break;
            case "Datumi Polaska":
                include "views/pages/adminStartDates.php";
                break;
            case "Anketa":
                include "views/pages/adminPolls.php";
                break;
            case "editCountry":
                include "views/pages/editCountry.php";
                break;
            case "adminUsers":
                include "views/pages/adminUsers.php";
                break;
            case "adminStartDates":
                include "views/pages/adminStartDates.php";
                break;
            case "adminMessages":
                include "views/pages/adminMessages.php";
                break;
            case "editUsers":
                include "views/pages/editUser.php";
                break;
            case "Log File":
                include "views/pages/logFile.php";
                break;
            case 'adminCountries':
                include "views/pages/adminCountries.php";
                break;
            case 'Offers':
                include "views/pages/adminOffers.php";
                break;
            case 'editOffer':
                include "views/pages/editOffer.php";
                break;
            case 'Reservations':
                include "views/pages/adminReservations.php";
                break;
            default:
                include "views/pages/home.php";
                break;
        }
    }

?>
<?php
include('views/fixed/footer.php');

?>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/admin.js"></script>