<!--
    Create by : Guillaume Hyvert
    Date : 03.05.2019
    Description : page where the user can see the list of his equipment and sort it
-->

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <link href="../../../ressources/css/style.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../js/tableHTMLExport.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" href="../../../ressources/images/favicon.png" />
    <script src="../../js/equipement.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>

    <title>Equipement</title>

</head>
<body>
    <!--Header(include)-->
    <header class="container mw-100 lighten-5">
        <?php
        include ('includes/header.inc.php');
        ?>
    </header>

    <!--Navigation to Account, main page, equipement management and contact-->
    <nav class="sticky-top">
        <ul class="nav nav-tabs nav-justified sticky-top">
            <li class="nav-item">
            <a class="nav-link" href="../controllers/mainController.php?view=Accueil">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="../controllers/mainController.php?view=Equipement">Mon équipement</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../controllers/mainController.php?view=Contact">Contact</a>
            </li>
        </ul>
        <div id="underNav" class="container col-12 pt-2">
    </nav>
    
    <!--Content of the page-->
    <section>
        <?php
        if(isset($_SESSION['connected']))
        {
            include '../models/mainModel.php';
            $MainModel = new mainModel();
            $categories= $MainModel->getAllCategories();
            ?>
            <div style="height:90px; top:55px;" id="searchOptions" class="col-12 px-0 border-bottom border-dark position-sticky">
                <div style="height:25px" class="col-12"></div>
                <div class="rounded bg-light p-0 float-left ml-4 mr-3 position-sticky" style="width:260px;">
                    <input class="form-control" id="myInput" type="text" placeholder="Rechercher..">
                </div>

                <img class="categoryTitle float-left ml-4 pb-2 pt-2" style="cursor:pointer;" id="price" onclick="HidePrice($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png">
                <a class="h3 ml-1 mb-0 float-left" style="width:300px;">Total: <label id = "totalText" style="display: none;" class="h3 text-success">0 CHF</label></a>
                

                <div class="dropdown float-right ml-4 position-sticky" style="width:200px;">
                    <button class="btn btn-secondary dropdown-toggle" style="width:170px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Catégories
                    </button>
                    <div class="dropdown-menu ddMenu overflow-auto" id="ddMenu" aria-labelledby="dropdownMenuButton">
                        <?php
                            foreach ($categories as $element)
                            {
                                ?><a id="<?php echo $element['catName']?>" class="dropdown-item pointy" onclick="changeType(this.id);"><?php echo $element['catName']?></a><?php
                            }
                        ?>
                    </div>
                </div>

                <div class="form-group form-check float-left ml-4 mt-1" style="width:120px;">
                    <input type="checkbox" class="form-check-input" id="sortEpi" style="width:20px;height:20px;" checked onclick="checkEverything();"><label class="form-check-label mt-1 ml-1" for="sortEpi">Matériel EPI</label>
                </div>
                <div class="form-group form-check float-left ml-4 mt-1" style="width:135px;">
                    <input type="checkbox" class="form-check-input" id="sortPerdu" style="width:20px;height:20px;" checked onclick="checkEverything();"><label class="form-check-label mt-1 ml-1" for="sortPerdu">Matériel Perdu</label>
                </div>
                <div class="form-group form-check float-left ml-4 mt-1" style="width:160px;">
                    <input type="checkbox" class="form-check-input" id="sortRebus" style="width:20px;height:20px;" checked onclick="checkEverything();"><label class="form-check-label mt-1 ml-1" for="sortRebus">Matériel au rebus</label>
                </div>
                <div class="form-group form-check float-left ml-4 mt-1" style="width:160px;">
                    <input type="checkbox" class="form-check-input" id="sortOther" style="width:20px;height:20px;" checked onclick="checkEverything();"><label class="form-check-label mt-1 ml-1" for="sortOther">Autres</label>
                </div>

                <button type="button" class="btn btn-success float-right" data-toggle="tooltip" data-placement="top" title="Ce bouton va télécharger le tableau ci-dessous comme il est affiché (pdf), ou bien toutes les données (csv)">
                    Télécharger
                </button>
            </div>
        
            <div class="container-fluid px-0 mt-4 opacityGrid" style = "overflow-x: scroll; scrollbar-x-position: top; direction: ltr;">            
                <table id="tableMain" class="mb-0 table table-striped">
                    <thead>
                        <tr id="trTitle">
                            <th id="categorieTitle" class="">Catégorie
                                <div>
                                    <img id = "upEmpty" class="up0" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 0, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down0" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 0, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="modeleTitle" class="">Modèle
                                <div>
                                    <img id = "upEmpty" class="up1" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 1, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down1" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 1, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="seriePersoTitle" class="">N° Série Perso
                                <div>
                                    <img id = "upEmpty" class="up2" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 2, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down2" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 2, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="serieProTitle" class="d-none">N° Série Pro
                                <div>
                                    <img id = "upEmpty"  class="up3" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 3, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down3" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 3, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="dateFabricationTitle" class="d-none">Date Fabrication
                                <div>
                                    <img id = "upEmpty" class="up4" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 4, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down4" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 4, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="dateAchatTitle" class="d-none">Date Achat
                                <div>
                                    <img id = "upEmpty" class="up5" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 5, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down5" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 5, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="dateUtilisationTitle" class="d-none">Date Utilisation
                                <div>
                                    <img id = "upEmpty" class="up6" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 6, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down6" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 6, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="dateFinVieTitle" class="d-none">Date Fin de vie
                                <div>
                                    <img id = "upEmpty" class="up7" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 7, '');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down7" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 7, '');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th class="">Prix (unité)
                                <div>
                                    <img id = "upEmpty" class="up8" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 8, 'price');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down8" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 8, 'price');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th class="">Nombre
                                <div>
                                    <img id = "upEmpty" class="up9" src="../../../ressources/images/up-arrow-empty.png" onclick="sortTable(true, 9, 'number');changeMe(this.id, $(this).attr('class'));">
                                    <img id = "downEmpty" class="down9" src="../../../ressources/images/down-arrow-empty.png" onclick="sortTable(false, 9, 'number');changeMe(this.id, $(this).attr('class'));">
                                </div>
                            </th>
                            <th id="perduTitle" class="d-none">Perdu</th>
                            <th id="EPITitle" class="d-none">EPI</th>
                            <th><img class="settingsTH float-right" style="cursor:pointer;" id="settingsTitle" src="../../../ressources/images/settings.png"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $infos= $MainModel->getbasicInfos($_SESSION["idUser"][0]["idUser"]);

                            foreach ($infos as $element)
                            {
                                if($element["matRebus"] == 1)
                                {
                                    ?>
                                    <tr style="background-color: rgba(255,0,0,0.2);" id='tr<?php echo $element["idMatos"]?>'>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <tr id='tr<?php echo $element["idMatos"]?>'>
                                    <?php
                                }
                                ?>
                                    <td class="categorieContent"><?php echo $element["matCatName"]?></td>
                                    <td class="modeleContent"><?php echo $element["matModal"]?></td>
                                    <td class="seriePersoContent"><?php echo $element["matSerialPerso"]?></td>
                                    <td class="serieProContent d-none"><?php echo $element["matSerialNumber"]?></td>
                                    <td class="dateFabricationContent d-none"><?php echo $element["matFabricationDate"]?></td>
                                    <td class="dateAchatContent d-none"><?php echo $element["matBoughtDate"]?></td>
                                    <td class="dateUtilisationContent d-none"><?php echo $element["matUseDate"]?></td>
                                    <td class="dateFinVieContent d-none"><?php echo $element["matEndLifeDate"]?></td>
                                    <td id="price"><?php echo $element["matPrice"] . " CHF" ?></td>
                                    <td id="number"><?php echo  "x" . $element["matNumber"]?></td>
                                    <td class="perduContent d-none"><?php if($element["matLost"]== 0){echo '<img src="../../../ressources/images/no.png">';} else{echo'<img src="../../../ressources/images/yes.png">';}?></td>
                                    <td class="EPIContent d-none"><?php if($element["matEPI"]== 0){echo '<img src="../../../ressources/images/no.png">';} else{echo'<img src="../../../ressources/images/yes.png">';}?></td>
                                    <td><img class="parameters" style="cursor:pointer;" id=<?php echo $element["idMatos"]?> src="../../../ressources/images/edit.png"></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>






            <img class="fixed-bottom m-4" id ="add" data-toggle="modal" data-target="#myModal" src="../../../ressources/images/add.png">


<!--========================================MODAL ADD EQUIPMENT=====================================-->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un équipement</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" id="formADD" enctype="multipart/form-data">
                            <div class="container col p-0">
                                <div class="container col-12 p-2" style="height:50px;">
                                    <label class="col-6 float-left text-right p-0 pt-1 pr-4">Type de matériel</label>
                                    <select id="type" name="type" class="col-3 float-left browser-default custom-select" required>
                                        <option value="void" id="void" name="void"></option>
                                        <div id="refresh">
                                            <?php
                                                $categories= $MainModel->getAllCategories();
                                                foreach ($categories as $element){
                                                    ?><option value="<?php echo $element['catName']?>" id="<?php echo $element['catName']?>" name="BD"><?php echo $element['catName']?></option><?php
                                                }
                                            ?>
                                        </div>
                                    </select>
                                    <img id ="addType" class="pt-1 pl-2" src="../../../ressources/images/addPlus.png">
                                    <img id ="deleteTypeADD" class="pt-1" src="../../../ressources/images/cross.png">
                                </div>

                                <div class="container col-12 p-0" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Modele</label>
                                <input class="col-3 float-left" type="text" name="modele" required>
                                </div>


                                <div class="container col-12 p-0 mt-4" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Nombre (unités)</label>
                                <input class="col-3 float-left" type="number" name="number" value="1" max='100' min="1" required>
                                </div>

                                <div class="container col-12 p-0" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Prix d'achat</label>
                                <input class="col-3 float-left" type="number" name="prix" value="0" max='100000' min="0" required>
                                </div>


                                <div class="container col-12 p-0 mt-4" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4 responsiveEquipement">Numéro de série (Fabriquant)</label>
                                <input class="col-3 float-left" type="text" name="serieFabriquant" required>
                                </div>

                                <div class="container col-12 p-0" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4 responsiveEquipement">Numéro de série (Perso)</label>
                                <input class="col-3 float-left" type="text" name="seriePerso" required>
                                </div>


                                <div class="container col-12 p-0 mt-4" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date de fabrication</label>
                                <input class="col-3 float-left" type="date" name="dateFabrication" required>
                                </div>

                                <div class="container col-12 p-0" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date d'achat</label>
                                <input class="col-3 float-left" type="date" name="dateAchat" required>
                                </div>

                                <div class="container col-12 p-0" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date d'utilisation</label>
                                <input class="col-3 float-left" type="date" name="dateUtilisation" required>
                                </div>

                                <div class="container col-12 p-0" style="height:36px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date de fin de vie</label>
                                <input class="col-3 float-left" type="date" name="dateFinVie" required>
                                </div>

                                <div class="container col-12 p-0 mt-4" style="height:36px;">
                                    <div class="container col-6 p-0 mx-auto text-center" style="height:36px;">
                                    <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Perdu" value="1">Perdu</label>
                                    <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="EPI" value="1">Matériel EPI</label>
                                    <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Rebus" value="1">Rebus</label>
                                    </div>
                                </div>

                                <div class="container col-12 mt-5 p-0" style="height:100%;">
                                <label class="col-12 text-center p-0">Description</label>
                                <textarea class="col-5 form-control mx-auto" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </form>
                        <div class="container text-center col-5 float-center p-0 mt-3" style="height:100%">
                            <label class="text-danger p-0" id="getChangeError"></label>
                            <label class="text-success p-0" id="getChangeSuccess"></label>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="buttonADD">Ajouter</button>      
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>

                    </div>
                </div>
            </div>

        <!--========================================MODAL ADD TYPE=====================================-->

            <div class="modal" id="myModal2">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un Type de matériel</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container col-8 mx-auto p-0" style="height:100%;">
                            <form method="post" id="formADD2" enctype="multipart/form-data">
                                <input class="col-12 mx-auto" type="text" name="addType" required>
                            </form>
                            <div class="container text-center col-12 float-center p-0 mt-4" style="height:100%">
                                <label class="text-danger p-0" id="getChangeError2"></label>
                                <label class="text-success p-0" id="getChangeSuccess2"></label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="buttonADD2">Ajouter</button>      
                        <button type="button" class="btn btn-danger" id="#closePopADD">Fermer</button>
                    </div>

                    </div>
                </div>
            </div>

            <!--========================================MODAL DELETE TYPE=====================================-->

            <div class="modal" id="myModalDeleteType">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Supprimer un Type de matériel</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container col-10 mx-auto p-0" style="height:100%;">
                            <form method="post" id="formDeleteType" enctype="multipart/form-data">
                                <select id="typeDelete" name="type" class="col-12 browser-default custom-select" required>
                                    <option value="" id="void" name=""></option>
                                    <div id="refresh">
                                        <?php
                                            $categoriesPerso = $MainModel->getPersoCategories();
                                            foreach ($categoriesPerso as $element){
                                                ?><option value=<?php echo $element['catName']?> id="BD" name="BD"><?php echo $element['catName']?></option><?php
                                            }
                                        ?>
                                    </div>
                                </select>
                            </form>
                            <div class="container text-center col-10 float-center p-0 mt-4" style="height:100%">
                                <label class="text-success p-0" id="getChangeType"></label>
                                <label class="text-danger p-0" id="getErrorType"></label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="w-100">
                            <button type="button" id="buttonDeleteType" class="btn btn-danger float-left">Supprimer</button>
                            <button type="button" class="btn btn-dark float-right" id="closePopDelete">Fermer</button>    
                        </div>
                    </div>

                    </div>
                </div>
            </div>
            <!--========================================MODAL EDIT=====================================-->

            <div class="modal" id="myModalEdit">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Éditer un équipement</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body Edit-->
                    <div class="modal-body" id="bodyEdit">    
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="w-100">
                            <button type="button" class="btn btn-danger float-left buttonDelete" data-dismiss="modal">Supprimer</button>
                            <button type="button" class="btn btn-dark float-right" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-success float-right mr-2 buttonEdit">Enregistrer</button>      
                        </div>
                    </div>

                    </div>
                </div>
            </div>

            <!--========================================MODAL CONFIRMATION DELETE=====================================-->
            <div class="modal" id="myModalConfirmation">
                <div class="modal-dialog modal-s">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Voulez-vous vraiment supprimer cet equipement?</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <div class="w-100">
                                <button type="button" class="btn btn-success float-left buttonConfirmation" data-dismiss="modal">Confirmer</button>
                                <button type="button" id="fckGoBack" class="btn btn-dark float-right">Annuler</button>    
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--========================================MODAL SETTINGS TITLE=====================================-->

            <div class="modal" id="myModalTitle">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Afficher</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body Edit-->
                    <div class="modal-body" id="bodyTitle">
                        <table class="ml-5 position-relative">
                            <thead>
                                <tr>
                                    <th class="pb-2">Catégorie</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="categorie" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eye.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">Modèle</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="modele" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eye.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">N° Série Perso</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="seriePerso" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eye.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">N° Série Pro</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="seriePro" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">Date de fabrication</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="dateFabrication" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">Date d'achat</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="dateAchat" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">Date d'utilisation</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="dateUtilisation" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">Date de fin de vie</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="dateFinVie" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">EPI</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="EPI" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png"></th>
                                </tr>
                                <tr>
                                    <th class="pb-2">Perdu</th>
                                    <th><img class="categoryTitle float-left ml-2 pb-2" style="cursor:pointer;" id="perdu" onclick="changeImage($(this).attr('id'))" src="../../../ressources/images/eyeclosed.png"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="w-100">
                            <button type="button" class="btn btn-dark float-right" data-dismiss="modal">Fermer</button>   
                        </div>
                    </div>

                    </div>
                </div>
            </div>

            <?php
        }
        else
        {
            ?>
                <div class="container text-center pt-5 col-8 float-center">
                    <p class="display-4">Vous devez vous connecter pour gérer votre équipement</p>
                    <input type="submit" class="btn-lg mt-5 btn-secondary btn-block" value="Connexion" onclick="window.location = '../controllers/mainController.php?view=Inscription'">
                </div>
            <?php
        }
        ?>
    </section>
    
    <footer class="container mw-100 footer" style="height:180px;">
        <?php
        include ('includes/footer.inc.php');
        ?>
    </footer>
</body>
    <script>
    var columns = {
    $categorie:true,
    $modele:true,
    $seriePerso:true,
    $seriePro:false,
    $dateFabrication:false,
    $dateAchat:false,
    $dateUtilisation:false,
    $dateFinVie:false,
    $EPI:false,
    $perdu:false};

    $lastModal = "";
    $lastID = "";

            //open modals
            $(document).ready(function(){
                $("#addType").click(function(){
                    $('#myModal').modal('toggle')
                    $('#myModal2').modal('toggle')
                    $lastModal = "#myModal";
                });

                $("#deleteTypeADD").click(function(){  
                    $('#myModal').modal('toggle')
                    $('#myModalDeleteType').modal('toggle')
                    $lastModal = "#myModal";
                });

                $("#settingsTitle").click(function(){
                    $('#myModalTitle').modal('toggle')
                });
                
                jQuery('#indique').css("overflow-y", "scroll");

                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            });



            //go back when validated
            $(document).on("click", "#addTypeEdit", function (){
                $('#myModalEdit').modal('toggle')
                $('#myModal2').modal('toggle')
                $lastModal = "#myModalEdit";
            });

            $(document).on("click", "#deleteTypeADDEdit", function (){
                $('#myModalEdit').modal('toggle')
                $('#myModalDeleteType').modal('toggle')
                $lastModal = "#myModalEdit";
            });

            //go back when closed
            $(document).on("click", "#closePopDelete", function(){
                $('#myModalDeleteType').modal('toggle');
                $($lastModal).modal('toggle');
            });

            $(document).on("click", "#closePopADD", function(){
                alert("test");
                $('#myModal2').modal('toggle');
                $($lastModal).modal('toggle');
            });

            $(document).on("click", "#fckGoBack", function (){
                $('#myModalConfirmation').modal('toggle')
                $('#myModalEdit').modal('toggle')
            });

            //other
            $('#ddMenu a').on('click', function (e) {
                e.stopPropagation();
            });
    </script>
</html>

