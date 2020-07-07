<?php
session_start();
if($_POST["type"]=="")
{
    echo "Veuillez sélectionner un type";
}
else
{
    include '../models/mainModel.php';
    $MainModel = new mainModel;
    $MainModel ->deleteType($_SESSION["idUser"][0]["idUser"], $_POST["type"]);
    echo "success-".$_POST["type"];
}