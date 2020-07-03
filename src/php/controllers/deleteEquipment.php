<?php
session_start();
include '../models/mainModel.php';
$MainModel = new mainModel;
$MainModel ->deleteEquipment($_SESSION["idUser"][0]["idUser"], $_POST["info"]);
echo "success";