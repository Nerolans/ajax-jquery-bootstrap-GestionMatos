<?php
session_start();

include '../models/mainModel.php';
$MainModel = new mainModel;
if(count($_POST)==0)
{
    echo "";
}
else
{
    $result = $MainModel ->getInfoByType($_POST["info"], $_SESSION["idUser"][0]["idUser"]);
    $final = "";
    foreach ($result as $element){
        foreach($element as $inception){
            $final .= '
                    <tr>
                        <td>'.$inception["matCatName"].'</td>
                        <td>'.$inception["matModal"].'</td>
                        <td>'.$inception["matSerialPerso"].'</td>
                        <td>'.$inception["matPrice"].' CHF</td>
                        <td>x'.$inception["matNumber"].'</td>
                        <td><img class="parameters" id ='.$inception["idMatos"].' src="../../../ressources/images/edit.png">
                    </tr>
                    ';
        }
    }
    echo $final;  
}