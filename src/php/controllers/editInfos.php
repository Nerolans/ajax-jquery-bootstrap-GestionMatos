<?php
session_start();
var_dump($_POST);

if($_POST['form']['type'] != "void")
{
    // regex check the inputs
    if (preg_match("@^[A-Z0-9a-zéèàê -]{0,50}$@",$_POST['form']['modele']))
    {        
        if(preg_match("@^[A-Za-z0-9/ -]{0,50}$@",$_POST['form']['serieFabriquant']))
        {                               
            if(preg_match("@^[A-Za-z0-9/ -]{0,50}$@",$_POST['form']['seriePerso']))
            {
                if($_POST['form']['number'] <= 100 && $_POST['form']['number'] >=0)
                {
                    
                    if(strlen($_POST['form']['description']) < 500)
                    {   
                        // if all checks went through
                        $EPI;
                        $Rebus;
                        $Perdu;
                        
                        // check all the boxes and setting them to 0 or 1 if they r checked
                        if(isset($_POST['form']['EPI']) && $_POST['form']['EPI'] == '1') 
                        {$EPI = 1;}else{$EPI = 0;}

                        if(isset($_POST['form']['Rebus']) && $_POST['form']['Rebus'] == '1') 
                        {$Rebus = 1;}else{$Rebus = 0;}

                        if(isset($_POST['form']['Perdu']) && $_POST['form']['Perdu'] == '1') 
                        {$Perdu = 1;}else{$Perdu = 0;}

                        if($_POST['form']['dateFabrication'] == ""){$_POST['form']['dateFabrication'] = "0000-01-01";}
                        if($_POST['form']['dateAchat'] == ""){$_POST['form']['dateAchat'] = "0000-01-01";}
                        if($_POST['form']['dateUtilisation'] == ""){$_POST['form']['dateUtilisation'] = "0000-01-01";}
                        if($_POST['form']['dateFinVie'] == ""){$_POST['form']['dateFinVie'] = "0000-01-01";}
                        
                        include '../models/mainModel.php';
                        $MainModel = new mainModel;

                        // adding the quipment
                        $MainModel ->addEquipment($_POST['form']['type'], $_POST['form']['modele'], $_POST['form']['number'], $_POST['form']['prix'], $_POST['form']['serieFabriquant'], $_POST['form']['seriePerso'], $_POST['form']['dateFabrication'], $_POST['form']['dateAchat'], $_POST['form']['dateUtilisation'], $_POST['form']['dateFinVie'], $EPI, $Rebus, $Perdu, $_POST['form']['description'], $_SESSION["idUser"][0]["idUser"]);
                        // returning the success and the line to add to the Equipment page
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
        }
        else
        {
            echo 'Le numero de serie du fabricant doit suivre les regles suivantes:
                  Caractères acceptés: A-Z a-z 0-9 /- espaces
                  Taille maximum: 50 caractères';
        }
    
    }
    else
    {
        echo 'Le modele doit suivre les regles suivantes:
                Taille maximum: 50 caractères
                Caractères acceptés: A-Z a-z 0-9 éèàê- espaces';
                
    }
}
else
{
   echo 'Veuillez entrer un type d\'équipement';
}