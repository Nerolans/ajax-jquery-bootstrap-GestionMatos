<?php
/**
 * Create by Guillaume Hyvert
 * Date: 15.11.2019
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
    
            

/* /////////Not implemented yet ("case" will go above this if its started)

    case "AjoutDeRecette":
        include '../views/ajoutRecette.php';
        break;

    case 'Connexion':
        include '../views/connexion.php';
        break;

    case 'Contact':
        include '../views/contact.php';
        break;

    case 'Inscription':
        include '../views/inscription.php';

        break;

    case 'ListeDeRecette':
        include '../views/listeRecettes.php';
        break;

    case 'Profile':
        session_destroy();
        include '../views/accueil.php';
        break;
*/
    ///////////////////////////////////////////////// redirect to a "check something" page (controller) \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/* ////////Not implemented yet ("case" will go above this if its started)

    case 'CheckAjoutRecette':
        include 'controllerFormAddRecipe.php';
        break;


    case 'CheckConnexion':
        include 'controllerConnexion.php';
        break;

    case 'CheckInscription':
        include 'controllerInscription.php';
        break;

    case 'CheckContact':
        include 'controllerInscription.php';
        break;

    case 'DetailRecette':
        include '../views/DetailsRecette.php';
        break;

    case 'Search';
        $_SESSION['searchedWord'] = $_POST['searchedWord'];
        include '../views/listeRecettes.php';
        break;
    */
    default: //page 404 if the user didnt put the correct URL
}

