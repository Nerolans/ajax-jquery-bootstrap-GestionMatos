<?php
/**
 * Page to sort by category
 */
session_start();

include '../models/mainModel.php';
$MainModel = new mainModel;
//if no categories are chosen
if(count($_POST)==0)
{
    echo "";
}
else
{
    //get the infos only with a certain type
    $result = $MainModel ->getInfoByType($_POST["info"], $_SESSION["idUser"][0]["idUser"]);
    $final = "";

    //showing it
    foreach ($result as $element){
        foreach($element as $inception){
            $final .= '
                    <tr id = "tr'.$inception["idMatos"].'">
                        <td>'.$inception["matCatName"].'</td>
                        <td>'.$inception["matModal"].'</td>
                        <td>'.$inception["matSerialPerso"].'</td>
                        <td id="price">'.$inception["matPrice"].' CHF</td>
                        <td id="number">x'.$inception["matNumber"].'</td>
                        <td><img class="parameters" id ='.$inception["idMatos"].' src="../../../ressources/images/edit.png">
                    </tr>
                    ';
        }
    }
    //returning final html to appen it with jquery
    echo $final;  
}