<?php
//Page Exist to check informations before connecting the user


// set variables
$toCheck = "";
$_SESSION["error"] == "";
// includes Modal.php (connnexion to DB)
include '../models/mainModel.php';
$MainModel = new mainModel;

// if the mail input dosnt exist in the DB
if(empty($MainModel->GetIdByMail($_POST['inputConnexionLogin'])))
{
    $_SESSION["error"]="Les informations rentrées sont incorrectes";
}
else
{
    //take the hash of the password for the user from the DB
    $toCheck = $MainModel->searchPasswordMail($_POST['inputConnexionLogin']);

    //hashing the password input and comparing it to the one from the DB
    if(password_verify($_POST['inputConnexionPassword'],$toCheck["UsePassword"]))
    {
        $toCheck = "";
        //setting the right variables
        $_SESSION['connected'] = true;

        //get the user ID and putting it into a session variable
        $_SESSION['idUser'] = $MainModel->getIdByMail($_POST["inputConnexionLogin"]);
        $_SESSION["error"] = "";
        header('Location:../controllers/mainController.php?view=Equipement');
    }
    else
    {
        $_SESSION["error"]="Les informations rentrées sont incorrectes";
    }
}

if($_SESSION["error"] !== "")
{
    header("location:../controllers/mainController.php?view=Connexion");
}