<?php
session_start();
if (!empty($_POST["contactName"]) && !empty($_POST["contactName"]) && !empty($_POST["contactDescription"]))
{
    include '../models/mainModel.php';
    $MainModel = new mainModel;
    $mail = $MainModel->getMailbyID($_SESSION["idUser"][0]["idUser"]);
    mail("epiadmin@myepi.cloud",utf8_decode($_POST["contactObject"]),"CONTACT MYEPI"."\nenvoye par: ".utf8_decode($mail[0]["useMail"])."\n Nom: ".utf8_decode($_POST["contactName"])."\n\n Objet: ".utf8_decode($_POST["contactObject"])."\n Message:".utf8_decode($_POST["contactDescription"]));
    echo "Success";
}
else
{
    echo "Veuillez remplir tous les champs";
}



