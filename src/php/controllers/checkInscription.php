<?php
/**
 * Description: Check validity of the inputts before adding the user into the DB
 */
$_SESSION["error"] = "";
$check = true;

include '../models/mainModel.php';
$MainModel = new mainModel;

// verif no empty
if (!empty($_POST['inputInscriptionNickname']) && !empty($_POST['inputInscriptionPassword']) && !empty($_POST['inputInscriptionEmail']))
{   
    // regex check the inputs
    if (preg_match("@^(.){1,20}$@",$_POST['inputInscriptionNickname']))
    {
        if (preg_match("@^[A-Za-z.$!?'éè:;^£<>*#%&()=~0123456789-]{8,40}$@",$_POST['inputInscriptionPassword']))
        {
            if (filter_var($_POST['inputInscriptionEmail'],FILTER_VALIDATE_EMAIL))
            {
                if(!empty($MainModel->checkMail($_POST['inputInscriptionEmail'])))
                {
                    // exemple of returning an error
                    $_SESSION["error"] = "L'adresse mail entré est déjà utilisé pour un autre compte";
                    $check = false;
                }

                if($_POST["inputInscriptionPassword"] !== $_POST["inputInscriptionPassword2"])
                {
                    $_SESSION["error"] = "Les mots de passes ne correspondent pas";
                    $check = false;
                }

                // adding infos into the DB aand getting the userID and putting it into a session variable for futur uses
                if($check == true)
                {                 
                    $MainModel ->addUser($_POST["inputInscriptionNickname"],$_POST["inputInscriptionEmail"],password_hash($_POST["inputInscriptionPassword"], PASSWORD_DEFAULT));

                    $_SESSION['idUser'] = $MainModel->getIdByUsername($_POST["inputInscriptionNickname"]);
                    $_SESSION['connected'] = true;

                    $_SESSION['error'] = "";

                    // going back to the main page
                    header('Location:../controllers/mainController.php?view=Accueil');
                    exit();
                }
            }
            else
            {
                $_SESSION["error"] = "L'adresse mail entré n'est pas valide";

            }
        }
        else
        {
            $_SESSION["error"] = "Le MDP entré n'est pas valide (8-40 caractères, carctères admis: . $ ! ? ' é è : ; ^ £ < > * # % & ( ) = ~ 0 1 2 3 4 5 6 7 8 9 - )";
        }
    }
    else
    {
        $_SESSION["error"] = "Le pseudo entré n'est pas valide (de 1 à 20 caractères, tout accepté)";
    }
}
else
{
    $_SESSION["error"] = "Certaines informations n'ont pas été complétés";
}

// refreshing the page if no success
if($_SESSION["error"] !== "")
{
    header("location:../controllers/mainController.php?view=Inscription");
}
