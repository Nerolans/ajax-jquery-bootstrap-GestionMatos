<!--
    Create by : Guillaume Hyvert
    Description : Page where the can reset his password after the link (token) was send by mail
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
    <title>Reset</title>

</head>
<body>

    <!--Header de la page qui contient un include-->
    <header class="container mw-100 lighten-5">
        <?php
            include ('includes/header.inc.php');
        ?>
    </header>

    <!--Navigation de la page qui contient les liens des autres pages-->
    <nav class="sticky-top">
        <ul class="nav nav-tabs nav-justified sticky-top">
            <li class="nav-item">
            <a class="nav-link" href="../controllers/mainController.php?view=Accueil">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../controllers/mainController.php?view=Equipement">Mon équipement</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../controllers/mainController.php?view=Contact">Contact</a>
            </li>
        </ul>
        <div id="underNav" class="container col-12 pt-2">
    </nav>

    <section>
    <div class="col-12" style="height: 60px"></div>
    <div class="container rounded col-8 float-center pt-3 bg-light p-0" style="opacity:75%;height:250px">
        <h4 class="pl-5 pt-2 text-muted">Changement du mot de passe</h4>
        <?php 
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            if(empty($selector) || empty($validator))
            {
                echo '<p class="text-warning p-3">Page inaccessible</p>';
            }
            else
            {
                ?>
                    <div class="container col-12 float-center text-center mt-3 p-0">
                        <form id="formResetValidate" method="post" action="../controllers/mainController.php?view=checkResetInfos">
                            <input type="hidden" name="selector" value=<?php echo ("'".$selector."'");?>>
                            <input type="hidden" name="validator" value=<?php echo ("'".$validator)."'";?>>
                            <div class="container col p-0">
                                <div class="container col-12 p-0" style="height:50px;">
                                    <label class="col-5 float-left text-right p-0 pt-1 pr-4">Nouveau mot de passe</label>
                                    <input class="col-3 float-left" type="password" name="inputPassword1">
                                </div>
                                <div class="container col-12 p-0" style="height:50px;">
                                    <label class="col-5 float-left text-right p-0 pt-1 pr-4">Confirmer</label>
                                    <input class="col-3 float-left" type="password" name="inputPassword2">
                                </div>
                                <div class="container col-12 p-0 pt-3">
                                    <input type="submit" class="btn btn-primary" name="passwordSubmit" value="Inscription">
                                </div>
                                <p class="text-Success p-3" id="messageResetValidate"><?php if(isset($_SESSION['errorReset'])){echo $_SESSION["error"];};?></p>
                                <p class="text-warning p-3" id="messageResetValidate"><?php if(isset($_SESSION['successReset'])){echo $_SESSION["success"];};?></p>
                            </div>
                        </form>
                    </div>
                <?php
            }
        ?>
    </div>
    </section>

    <!--Footer de la page qui contient un include-->
    <footer>
        <?php
            include ('includes/footer.inc.php');
        ?>
    </footer>
</body>
</html>