<?php
/**
 * Created by PhpStorm.
 * User: hyvertgu
 * Date: 18.03.2019
 * Time: 08:56
 * Description: Vérifie la validité des informations entrées lors de l'inscription.
 */
$_SESSION["error"] = "";
$check = true;

include '../models/mainModel.php';
$MainModel = new mainModel;

# Vérifie qu'aucun champ soit vide
if (!empty($_POST['inputInscriptionNickname']) && !empty($_POST['inputInscriptionPassword']) && !empty($_POST['inputInscriptionEmail']))
{   
    # Vérifie la validité du pseudo
    if (preg_match("@^(.){1,20}$@",$_POST['inputInscriptionNickname']))
    {
        # Vérifie la validité du mot de passe
        if (preg_match("@^[A-Za-z.$!?'éè:;^£<>*#%&()=~0123456789-]{8,40}$@",$_POST['inputInscriptionPassword']))
        {
            # Vérifie la validité de l'email
            if (filter_var($_POST['inputInscriptionEmail'],FILTER_VALIDATE_EMAIL))
            {
                # Vérifie que l'email entrée ne soit pas déjà utilisée
                if(!empty($MainModel->checkMail($_POST['inputInscriptionEmail'])))
                {
                    $_SESSION["error"] = "L'adresse mail entré est déjà utilisé pour un autre compte";
                    $check = false;
                }

                if($_POST["inputInscriptionPassword"] !== $_POST["inputInscriptionPassword2"])
                {
                    $_SESSION["error"] = "Les mots de passes ne correspondent pas";
                    $check = false;
                }

                # Crée les variables de sessions si le pseudo et l'email entré ne sont pas déjà utiliser
                if($check == true)
                {                 
                    $MainModel ->addUser($_POST["inputInscriptionNickname"],$_POST["inputInscriptionEmail"],password_hash($_POST["inputInscriptionPassword"], PASSWORD_DEFAULT));

                    $_SESSION['idUser'] = $MainModel->getIdByUsername($_POST["inputInscriptionNickname"]);
                    $_SESSION['connected'] = true;

                    $_SESSION["error"] = "";
                    header('Location:../controllers/mainController.php?view=Accueil');
                    exit();
                }
            }
            # Si l'email n'est pas valide
            else
            {
                $_SESSION["error"] = "L'adresse mail entré n'est pas valide";

            }
        }
        # Si le mot de passe n'est pas valide
        else
        {
            $_SESSION["error"] = "Le MDP entré n'est pas valide (8-40 caractères, carctères admis: . $ ! ? ' é è : ; ^ £ < > * # % & ( ) = ~ 0 1 2 3 4 5 6 7 8 9 - )";
        }
    }
    # Si le pseudo n'est pas valide
    else
    {
        $_SESSION["error"] = "Le pseudo entré n'est pas valide (de 1 à 20 caractères, tout accepté)";
    }
}
#Si tous les champs ne sont pas remplis
else
{
    $_SESSION["error"] = "Certaines informations n'ont pas été complétés";
}

//regarde si tout à bien été validé
if($_SESSION["error"] !== "")
{
    header("location:../controllers/mainController.php?view=Inscription");
}
