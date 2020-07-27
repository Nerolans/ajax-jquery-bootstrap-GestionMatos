<?php
/**
 * Description: check if Name and/or Email exists in DB
 */
session_start();
    if(!empty($_POST['name']))
    {
        include '../models/mainModel.php';
        $MainModel = new mainModel;
        $toValidMail = $MainModel->getIdByMail($_POST["name"]);
        if(!empty($toValidMail))
        {
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $link = explode("/controllers",$_SERVER["PHP_SELF"])[0].'/views/newPassword.php?selector='.$selector.'&validator='.bin2hex($token);
            $expires = date("U") + 1200;
            
            $MainModel->setTokenInfos($selector,password_hash($token, PASSWORD_DEFAULT),$expires,$toValidMail);
            
            // the message
            $msg = "Cliquez sur ce lien pour changer votre mot de passe:\n"."https://myepi.cloud".explode("/controllers",$_SERVER["PHP_SELF"])[0].'/views/newPassword.php?selector='.$selector.'&validator='.bin2hex($token);
            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);
            // send email
            mail($_POST["name"],"Changement de mot de passe",$msg);
     
            echo "Success";
        }
        else
        {
            echo 'Cet Email ne correspond à aucun compte existant - Utilisez la page "Contact" en cas de problèmes';
        }
    }
    else
    {
        echo "Vous devez rentrer l'Email lié à votre compte myEPI";
    }
?>