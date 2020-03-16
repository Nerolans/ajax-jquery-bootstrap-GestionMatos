<?php
$toCheck = "";
$_SESSION["error"] == "";
include '../Models/mainModel.php';
$MainModel = new mainModel;

if(empty($MainModel->GetIdByMail($_POST['inputConnexionLogin'])))
{
    $_SESSION["error"]="Les informations rentrées sont incorrectes";
}
else
{
    $toCheck = $MainModel->searchPasswordMail($_POST['inputConnexionLogin']);
    if(password_verify($_POST['inputConnexionPassword'],$toCheck["UsePassword"]))
    {
        $toCheck = "";
        $_SESSION['connected'] = true;
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