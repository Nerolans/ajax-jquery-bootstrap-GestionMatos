<?php
/**
 * Description: check if Name and/or Email exists in DB
 */
session_start();
    if(!empty($_POST['name']))
    {
        include '../models/mainModel.php';
        $MainModel = new mainModel;
        $toValidName = $MainModel->getIdByUsername($_POST["name"]);
        $toValidMail = $MainModel->getIdByMail($_POST["name"]);
        if(!empty($toValidMail)||!empty($toValidName))
        {
            echo "Success";
            exit();
        }
        else
        {
            echo 'Ce nom / Email ne correspond à aucun compte existant - Utilisez la page "Contact" en cas de problèmes';
        }
    }
    else
    {
        echo "Vous devez rentrer votre nom ou Email";
    }
?>