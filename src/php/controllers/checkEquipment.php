<?php
/**
 * Author: Guillaume Hyvert
 * Date: beggining of 2020
 * Description: Check the validity of the equipment before adding ot to the BD
 */
session_start();
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
                    
                    if(strlen($_POST['description']) < 500)
                    {   
                        $EPI;
                        $Rebus;
                        $Perdu;

                        if(isset($_POST['EPI']) && $_POST['EPI'] == '1') 
                        {$EPI = 1;}else{$EPI = 0;}

                        if(isset($_POST['Rebus']) && $_POST['Rebus'] == '1') 
                        {$Rebus = 1;}else{$Rebus = 0;}

                        if(isset($_POST['Perdu']) && $_POST['Perdu'] == '1') 
                        {$Perdu = 1;}else{$Perdu = 0;}

                        include '../Models/mainModel.php';
                        $MainModel = new mainModel;
                        $MainModel ->addEquipment($_POST['type'], $_POST['modele'], $_POST['number'], $_POST['prix'], $_POST['serieFabriquant'], $_POST['seriePerso'], $_POST['dateFabrication'], $_POST['dateAchat'], $_POST['dateUtilisation'], $_POST['dateFinVie'], $EPI, $Rebus, $Perdu, $_POST['description'], $_SESSION["idUser"][0]["idUser"]);
                        echo "Success-"."<tr><td>".$_POST['type']."</td><td>".$_POST['modele']."</td><td>".$_POST['seriePerso']."</td><td>".$_POST['prix']." CHF"."</td></tr>";
                        exit();
                    }
                    else
                    {
                        echo 'La description ne doit pas dépasser 500 caractères';
                    }
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



