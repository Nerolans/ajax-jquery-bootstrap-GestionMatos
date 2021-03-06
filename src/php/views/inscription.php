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
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <title>Inscription</title>

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

    <div class="col-12" style="height: 60px"></div>
        <div class="container rounded col-8 float-center pt-3 bg-light responsiveInscription p-0" style="opacity:75%;">
            <h4 class="pl-5 pt-2 text-muted">Inscription</h4>
            <div class="container col-12 float-center text-center mt-3 p-0">
                <div style="height:60px;">
                    <p>Vous possèdez déjà un compte? <a href="../controllers/mainController.php?view=Connexion">Connectez-vous</a></p>
                </div>
                <form name="formInscription" method="post" action="../controllers/mainController.php?view=checkInscription">
                    <div class="container col p-0">
                        <div class="container col-12 p-0" style="height:50px;">
                            <label class="col-5 float-left text-right p-0 pt-1 pr-4">Nom</label>
                            <input class="col-3 float-left" type="text" name="inputInscriptionNickname">
                        </div>
                        <div class="container col-12 p-0" style="height:50px;">
                            <label class="col-5 float-left text-right p-0 pt-1 pr-4">E-Mail</label>
                            <input class="col-3 float-left" type="text" name="inputInscriptionEmail">
                        </div>
                        <div class="container col-12 p-0" style="height:50px;">
                            <label class="col-5 float-left text-right p-0 pt-1 pr-4">Mot de passe</label>
                            <input class="col-3 float-left" type="password" name="inputInscriptionPassword">
                        </div>
                        <div class="container col-12 p-0" style="height:50px;">
                            <label class="col-5 float-left text-right p-0 pt-1 pr-4">Confirmer</label>
                            <input class="col-3 float-left" type="password" name="inputInscriptionPassword2">
                        </div>
                        <div class="container col-12 p-0 pt-3">
                            <input type="submit" class="btn btn-primary" value="Inscription">
                        </div>
                        <p class="text-danger p-3"><?php if(isset($_SESSION['error'])){echo $_SESSION["error"];}; ?></p>
                    </div>
                </form>
            </div>
        </div>

</section>

    <!--Footer de la page qui contient un include normalement-->
    <footer>
    </footer>
</body>
</html>