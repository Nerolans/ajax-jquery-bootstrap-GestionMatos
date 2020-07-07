<?php
session_start();
include '../models/mainModel.php';
$MainModel = new mainModel;
$MainModel ->deleteType($_SESSION["idUser"][0]["idUser"], $_POST["type"]);
echo "success-".$_POST["type"];