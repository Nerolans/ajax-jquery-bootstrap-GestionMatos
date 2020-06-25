<?php
/**
 * Desciption: redirect to the correct pages 
 */
$view =$_GET['view'];
session_start();

switch ($view)
{
    ///////////////////////////////////////////////// Redirect to the correct page (view) \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    case "Accueil":
        include '../views/accueil.php';
        break;

    case "Equipement":
        include '../views/equipement.php';
        break;

    case "Contact":
        include '../views/contact.php';
        break;
    
    case "Inscription":
        include '../views/inscription.php';
        break;

    case "Settings":
        include '../views/settings.php';
        break;

    case "Connexion":
        include '../views/connexion.php';
        break;

    case "checkEquipment":
        include 'checkEquipment.php';
        break;

    case "addEquipment":
        include '../views/addEquipment.php';
        break;

    case "checkInscription":
        include 'checkInscription.php';
        break;

    case "checkConnexion":
        include 'checkConnexion.php';
        break;

    case "checkSettings":
        include 'checkSettings.php';
        break;
    
    case "Destroy":
        session_destroy();
        header("location:mainController.php?view=Accueil");

    default: //page 404 if the user didnt put the correct URL
}

