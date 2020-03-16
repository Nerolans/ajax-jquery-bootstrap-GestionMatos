<?php
session_start();
    if(!empty($_POST['addType']))
    {
        if (preg_match("@^[A-Z0-9a-zéèàê -]{1,50}$@",$_POST['addType']))
        {
            include '../Models/mainModel.php';
            $MainModel = new mainModel;
            $MainModel ->addPersoType($_POST['addType'], $_SESSION["idUser"][0]["idUser"]);
            echo "Success";
            exit();
        }
        else
        {
            echo 'Le modele doit suivre les règles suivantes: Taille maximum: 50 caractères, Caractères acceptés: A-Z a-z 0-9 éèàê- espaces';
        }
    }
    else
    {
        echo "Vous devez rentrer une valeur";
    }
?>