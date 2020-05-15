<!--
    Create by : Guillaume Hyvert
    Date : 03.05.2019
    Description : page where the user can see the list of his equipment and sort it
-->

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <link href="../../../Ressources/css/style.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" href="../../../Ressources/images/favicon.png" />
    <script src="../../js/equipement.js"></script>
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
            include '../Models/mainModel.php';
            $MainModel = new mainModel();
            $categories= $MainModel->getAllCategories();
            ?>
            <div style="height:90px; top:55px;" id="searchOptions" class="col-12 container px-0 border-bottom border-dark position-sticky">
                <div style="height:25px" class="col-12"></div>
                <div class="rounded bg-light p-0 float-left ml-4 position-sticky" style="width:260px; top:80px; left:20px;">
                    <input class="form-control" id="myInput" type="text" placeholder="Rechercher..">
                </div>

                <div class="rounded bg-light p-0 float-right ml-4 position-sticky" style="width:260px; top:80px; right:20px;">
                    <a href="#demo" class="btn btn-secondary" data-toggle="collapse" id="typeTitle" style="width:100%;">Type d'équipement ▸</a>
                    <?php
                        foreach ($categories as $element)
                        {
                            ?><div id="demo" class="collapse p-0"><a id="<?php echo $element['catName']?>" onclick="typeClick(this.id)" class="btn btn-outline-dark p-1" collapse" style="width:100%;"><?php echo $element['catName']?></a></div><?php
                        }
                    ?>
                </div>
            </div>

            <div class="container px-0 mt-4 opacityGrid">            
                <table id="tableMain" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Modèle</th>
                        <th>N° Série Perso</th>
                        <th>Prix</th>
                        <th>Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $infos= $MainModel->getbasicInfos();

                            foreach ($infos as $element)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $element["matCatName"]?></td>
                                    <td><?php echo $element["matModal"]?></td>
                                    <td><?php echo $element["matSerialPerso"]?></td>
                                    <td><?php echo $element["matPrice"] . " CHF" ?></td>
                                    <td><?php echo  "x" . $element["matNumber"]?></td>
                                    <td><img class="" id = <?php echo $element["idMatos"]?> onclick="fillModal(this.id)" src="../../../ressources/images/edit.png">
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                </div>






            <img class="fixed-bottom m-4" id ="add" data-toggle="modal" data-target="#myModal" src="../../../ressources/images/add.png">



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
                                                    ?><option value="<?php echo $element['catName']?>" id="BD" name="BD"><?php echo $element['catName']?></option><?php
                                                }
                                            ?>
                                        </div>
                                    </select>
                                    <img id ="addType" class="pt-1 pl-2" src="../../../ressources/images/addPlus.png">
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
                                    <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="EPI" value="1">Matériel EPI</label>
                                    <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Rebus" value="1">Rebus</label>
                                    <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Perdu" value="1">Perdu</label>
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

        <!----------------------------------------------------------------------------------------------------------------------------->

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
                        <button type="button" id="dismissType" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>

                    </div>
                </div>
            </div>

            <!----------------------------------------------------------------------------------------------------------------------------->

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
                        <button type="button" class="btn btn-success" id="buttonADD">Enregistrer</button>      
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
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
</body>
    <script>
            $(document).ready(function(){
                $("#addType").click(function(){
                    $('#myModal').modal('toggle')
                    $('#myModal2').modal('toggle')
                });

                $("#dismissType").click(function(){
                    $('#myModal').modal('toggle')
                    $('#myModal').css('overflow-y', 'auto');
                });

                jQuery('#indique').css("overflow-y", "scroll");
            });
    </script>
</html>

