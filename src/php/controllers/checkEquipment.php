<?php
/**
 * Created by PhpStorm.
 * User: stegmannth
 * Date: 08.04.2019
 * Time: 08:56
 * Description: Vérifie la validité des informations entrées lors de l'ajout d'une recette.
 */
exit();
# Vérifie que toute les box contiennent quelque chose
if (!empty($_POST['modele']) && $_POST['type'] != "void" && !empty($_POST['number']) && $_POST['prix']>=0 && !empty($_POST['serieFabriquant']) && !empty($_POST['seriePerso']) && !empty($_POST['dateFabrication']) && !empty($_POST['dateUtilisation']) && !empty($_POST['dateFinVie']))
{
    # Check "Modele"
    if (preg_match("@^[A-Z0-9a-zéèàê -]{1,50}$@",$_POST['modele']))
    {

        if(preg_match("@^[A-Za-z0-9/ -]{1,50}$@",$_POST['serieFabriquant']))
        {         
            # Vérifie le format de la text area des étapes
            if(preg_match("@^[A-Za-z0-9/ -]{1,50}$@",$_POST['seriePerso']))
            {
                if($_POST['number'] <= 100 && $_POST['number'] >=0)
                {
                    if(!empty($_POST['uploadedImage']))
                    {
                        # Vérifie si l'utilisateur a upload un fichier
                        if(is_uploaded_file($_FILES['uploadedImage']['tmp_name']))
                        {
                            $imageFileType = strtolower(pathinfo($_FILES['uploadedImage']['name'], PATHINFO_EXTENSION));

                            # Vérifie que lformat du fichier upload
                            if ($imageFileType == "jpg" or $imageFileType == "png")
                            {
                                $MainModel = new mainModel();

                                $name = time().$_FILES['uploadedImage']['name'];
                                $tmpName = $_FILES['uploadedImage']['tmp_name']; //ou est stocké le fichier à l'origine
                                $error = $_FILES['uploadedImage']['error'];
                                $destination = "../../../Ressources/imagesMatosClients/";

                                switch ($error) {
                                    case UPLOAD_ERR_NO_FILE:
                                        echo "Veuillez ajouter un image";
                                        break;
                                    case UPLOAD_ERR_FORM_SIZE:
                                        echo "l'image à ajouter est trop volumineuse";
                                        break;
                                    default:
                                        echo "une erreur lié à l'ajout de l'image est survenue veuillez réessayer plus tard";
                                    case UPLOAD_ERR_OK:
                                        move_uploaded_file($tmpName, $destination . $name);

                                        //$MainModel->addRecipe($_POST['recipeTitle'], $_POST['listingredients'], $_POST['listSteps'], $name, $_SESSION['idUtil']['idUtil'], $idCatTab[0]['idCat']);
                                        echo "Success";
                                        exit();
                                        break;
                                }
                            }

                            # Si le format n'est pas valide
                            else
                            {
                                echo "L'image doit être au format .jpg ou .png";
                            }
                        }
                        else
                        {
                            echo "une erreur lié à l'ajout de l'image est survenue veuillez réessayer plus tard";
                        }
                    }
                    else
                    {
                        var_dump($_FILES);
                        //A AJOUTER L'AJOUT SANS IMAGES
                    }

                # Si aucune image n'a été importée
                }
                else
                {
                    echo 'Le nombre d\'unité à ajouter doit être compris entre 1(min) et 99(max)';
                }
            }
            else
            {
                echo 'Le numero de serie personnel doit suivre les regles suivantes:
                  Caractères acceptés: A-Z a-z 0-9 /- espaces
                  Taille maximum: 50 caractères';
            }
            
            # Si la préparation n'est pas valide

        }
        else
        {
            echo 'Le numero de serie du fabricant doit suivre les regles suivantes:
                  Caractères acceptés: A-Z a-z 0-9 /- espaces
                  Taille maximum: 50 caractères';
        }
    
    }
    # if regex for "modele" find no matches
    else
    {
        echo 'Le modele doit suivre les regles suivantes:
                Taille maximum: 50 caractères
                Caractères acceptés: A-Z a-z 0-9 éèàê- espaces';
                
    }
}

# Si tous les champs ne sont pas remplis
else
{
    echo 'Certaines informations obligatoires n\'ont pas été renseignées';
}



