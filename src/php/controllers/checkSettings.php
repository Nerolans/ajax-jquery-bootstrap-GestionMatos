<?php
/**
 * Description: check new name in settings before changing it in DB
 */
$_SESSION["error"] = "";
$check = true;

include '../models/mainModel.php';
$MainModel = new mainModel;

// Vérifie qu'aucun champ soit vide
if (!empty($_POST['inputInscriptionNickname']) && !empty($_POST['inputInscriptionPassword']))
{   
    // Vérifie la validité du pseudo
    if (preg_match("@^(.){1,20}$@",$_POST['inputInscriptionNickname']))
    {
        var_dump($_SESSION["idUser"][0]["idUser"]);
        $toCheck = $MainModel->searchPasswordID($_SESSION["idUser"][0]["idUser"]);
        if(password_verify($_POST['inputInscriptionPassword'],$toCheck["UsePassword"]))
        {
            $_SESSION["error"] = "";
            $_SESSION["validation"] = true;
            $MainModel->modifUser($_POST["inputInscriptionNickname"]);
            header('Location:../controllers/mainController.php?view=Settings');
        }
        else
        {
            $_SESSION["error"] = "Mauvais mot de passe";
        }
    }
    // Si le pseudo n'est pas valide
    else
    {
        $_SESSION["error"] = "Le pseudo entré n'est pas valide (de 1 à 20 caractères, tout accepté)";
    }
}
//Si tous les champs ne sont pas remplis
else
{
    $_SESSION["error"] = "Certaines informations n'ont pas été complétés";
}

//regarde si tout à bien été validé
if($_SESSION["error"] !== "")
{
    header("location:../controllers/mainController.php?view=Settings");
}

