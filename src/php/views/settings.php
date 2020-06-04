<!--
    Create by : Guillaume Hyvert
    Date : 26.12.2019
    Description : Page where the user can log into his account.
-->

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
    <link href="../../../ressources/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" href="../../../ressources/images/favicon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Paramètres</title>

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
    <!--Section qui contient le contenu de la page-->
    <section>
        <div class="container col-12" style="height:40px;"></div>

        <div class="container rounded col-8 float-center bg-light" style="opacity:75%; height:45px;">
            <p class="col-6 float-left text-left p-0 pt-2 ">Paramètres</p>
            <a href="../../php/controllers/mainController.php?view=Destroy"><img src="../../../ressources/images/deco.png" id="quit" class="img-fluid d-block pt-2 mr-1 float-right" alt="image to connect"></a>
        </div>

        <script>
        $(document).ready(function(){

        $('#quit').hover(function(){
            $(this).attr("src","../../../ressources/images/deco2.png");
        }, function(){$(this).attr("src","../../../ressources/images/deco.png");});

        });
        </script>

        <div class="container col-12" style="height:20px;"></div>

        <div class="container rounded col-8 float-center pt-1 bg-light p-0" style="opacity:75%; height:300px;">
            <div class="container col-12 float-center text-center mt-4 p-0">
                <!--Formulaire permettant de s'inscrire-->
                <?php
                    include '../models/mainModel.php';
                    $MainModel = new mainModel();
                    $recipes = $MainModel->GetUserInfo($_SESSION["idUser"][0]["idUser"]);
                ?>
                <div id="divInputInscription">
                        <form name="formInscription" method="post" action="../controllers/mainController.php?view=checkSettings">
                            <div class="container col-12 p-0" style="height:50px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Nom</label>
                                <input type="text" class="col-3 float-left" style="font-size: 14px;" type="text" name="inputInscriptionNickname" value="<?php echo $recipes[0]["useOrganisation"] ?>">
                            </div>

                            <div class="container col-12 p-0" style="height:50px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">E-Mail</label>
                                <input type="text" class="col-2 float-left" type="text" id="inputInscriptionEmail" name="inputInscriptionEmail" value="<?php echo $recipes[0]["useMail"] ?>" disabled>
                            </div>

                            <div class="container col-12 p-0" style="height:50px;">
                                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Mot de passe</label>
                                <input type="password" class="col-2 float-left" type="text" id="inputInscriptionPassword" name="inputInscriptionPassword">
                            </div>

                            <div class="container col-12 p-0 pt-3">
                                <input type="submit" class="btn btn-primary" value="Modifier">
                            </div>
                            <p class="text-danger p-3"><?php if(isset($_SESSION['error'])){echo $_SESSION["error"];}; ?></p>
                            <p class="text-success p-3"><?php if(isset($_SESSION['validation'])){echo "Les informations ont bien été modifiées";} ?></p>
                            <?php unset($_SESSION['validation']) ?>
                        </form>
                    </div>
                </div>
            </div>
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