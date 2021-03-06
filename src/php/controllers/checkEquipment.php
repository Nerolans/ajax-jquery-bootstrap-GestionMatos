<?php
/**
 * Author: Guillaume Hyvert
 * Date: beggining of 2020
 * Description: Check the validity of the equipment before adding ot to the BD
 */
session_start();
// check the inputs 
//if (!empty($_POST['modele']) && $_POST['type'] != "void" && !empty($_POST['number']) && $_POST['prix']>=0 && !empty($_POST['serieFabriquant']) && !empty($_POST['seriePerso']) && !empty($_POST['dateFabrication']) && !empty($_POST['dateUtilisation']) && !empty($_POST['dateFinVie']))
if($_POST['type'] != "void")
{
    // regex check the inputs
    if (preg_match("@^[A-Z0-9a-zéèàê -]{0,50}$@",$_POST['modele']))
    {        
        if(preg_match("@^[A-Za-z0-9/ -]{0,50}$@",$_POST['serieFabriquant']))
        {                               
            if(preg_match("@^[A-Za-z0-9/ -]{0,50}$@",$_POST['seriePerso']))
            {
                if($_POST['number'] <= 100 && $_POST['number'] >=0)
                {
                    
                    if(strlen($_POST['description']) < 500)
                    {   
                        // if all checks went through
                        $EPI;
                        $Rebus;
                        $Perdu;
                        
                        // check all the boxes and setting them to 0 or 1 if they r checked
                        if(isset($_POST['EPI']) && $_POST['EPI'] == '1') 
                        {$EPI = 1;}else{$EPI = 0;}

                        if(isset($_POST['Rebus']) && $_POST['Rebus'] == '1') 
                        {$Rebus = 1;}else{$Rebus = 0;}

                        if(isset($_POST['Perdu']) && $_POST['Perdu'] == '1') 
                        {$Perdu = 1;}else{$Perdu = 0;}

                        if($_POST['dateFabrication'] == ""){$_POST['dateFabrication'] = "0000-01-01";}
                        if($_POST['dateAchat'] == ""){$_POST['dateAchat'] = "0000-01-01";}
                        if($_POST['dateUtilisation'] == ""){$_POST['dateUtilisation'] = "0000-01-01";}
                        if($_POST['dateFinVie'] == ""){$_POST['dateFinVie'] = "0000-01-01";}
                        
                        include '../models/mainModel.php';
                        $MainModel = new mainModel;

                        // adding the equipment
                        $equipmentID = $MainModel ->addEquipment($_POST['type'], $_POST['modele'], $_POST['number'], $_POST['prix'], $_POST['serieFabriquant'], $_POST['seriePerso'], $_POST['dateFabrication'], $_POST['dateAchat'], $_POST['dateUtilisation'], $_POST['dateFinVie'], $EPI, $Rebus, $Perdu, $_POST['description'], $_SESSION["idUser"][0]["idUser"]);
                        
                        if($Rebus != 0)
                        {
                            $ImgEPI = "";
                            if($EPI == 0){$ImgEPI = "<img src='../../../ressources/images/no.png'>";}
                            if($EPI == 1){$ImgEPI = "<img src='../../../ressources/images/yes.png'>";}

                            $Lost = "";
                            if($Perdu == 0){$Lost = "<img src='../../../ressources/images/no.png'>";}
                            if($Perdu == 1){$Lost = "<img src='../../../ressources/images/yes.png'>";}
                            echo "Success|"."
                            <tr style='background-color: rgba(255,0,0,0.2);' id='tr".$equipmentID[0]['idMatos']."'>
                                <td class='categorieContent'>".$_POST['type']."</td>
                                <td class='modeleContent'>".$_POST['modele']."</td>
                                <td class='seriePersoContent'>".$_POST['seriePerso']."</td>
                                <td class='serieProContent d-none'>".$_POST['serieFabriquant']."</td>
                                <td class='dateFabricationContent d-none'>".$_POST['dateFabrication']."</td>
                                <td class='dateAchatContent d-none'>".$_POST['dateAchat']."</td>
                                <td class='dateUtilisationContent d-none'>".$_POST['dateUtilisation']."</td>
                                <td class='dateFinVieContent d-none'>".$_POST['dateFinVie']."</td>
                                <td id=\"price\">".$_POST['prix']." CHF"."</td>
                                <td id=\"number\">x".$_POST['number']."</td>
                                <td class='perduContent d-none'>".$Lost."</td>
                                <td class='EPIContent d-none'>".$ImgEPI."</td>
                                <td><img class='parameters' id = ".$equipmentID[0]['idMatos']." src='../../../ressources/images/edit.png'></td> 
                            </tr>|tr".$equipmentID[0]['idMatos'];
                        }
                        else
                        {
                            // returning the success and the line to add to the Equipment page
                            $ImgEPI = "";
                            if($EPI == 0){$ImgEPI = "<img src='../../../ressources/images/no.png'>";}
                            if($EPI == 1){$ImgEPI = "<img src='../../../ressources/images/yes.png'>";}

                            $Lost = "";
                            if($Perdu == 0){$Lost = "<img src='../../../ressources/images/no.png'>";}
                            if($Perdu == 1){$Lost = "<img src='../../../ressources/images/yes.png'>";}
                            echo "Success|"."
                            <tr id='tr".$equipmentID[0]['idMatos']."'>
                                <td class='categorieContent'>".$_POST['type']."</td>
                                <td class='modeleContent'>".$_POST['modele']."</td>
                                <td class='seriePersoContent'>".$_POST['seriePerso']."</td>
                                <td class='serieProContent d-none'>".$_POST['serieFabriquant']."</td>
                                <td class='dateFabricationContent d-none'>".$_POST['dateFabrication']."</td>
                                <td class='dateAchatContent d-none'>".$_POST['dateAchat']."</td>
                                <td class='dateUtilisationContent d-none'>".$_POST['dateUtilisation']."</td>
                                <td class='dateFinVieContent d-none'>".$_POST['dateFinVie']."</td>
                                <td id=\"price\">".$_POST['prix']." CHF"."</td>
                                <td id=\"number\">x".$_POST['number']."</td>
                                <td class='perduContent d-none'>".$Lost."</td>
                                <td class='EPIContent d-none'>".$ImgEPI."</td>
                                <td><img class='parameters' id = ".$equipmentID[0]['idMatos']." src='../../../ressources/images/edit.png'></td> 
                            </tr>|tr".$equipmentID[0]['idMatos'];
                        }
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



