<!--
    Create by : Guillaume Hyvert
    Date : 26.12.2019
    Description : Page where the user can log into his account.
-->

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
    <link href="../../../Ressources/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" href="../../../Ressources/images/favicon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Connexion</title>

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
        <div class="container rounded col-8 float-center pt-3 bg-light p-0" style="opacity:75%;height:350px">
            <h4 class="pl-5 pt-2 text-muted">Connexion</h4>
            <div class="container col-12 float-center text-center mt-3 p-0">
                <div style="height:60px;">
                    <p>Vous n'avez pas encore de compte? <a href="../controllers/mainController.php?view=Inscription">Inscrivez-vous</a></p>
                </div>
                <form name="formInscription" method="post" action="../controllers/mainController.php?view=checkConnexion">
                    <div class="container col p-0">
                        <div class="container col-12 p-0" style="height:50px;">
                            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Email</label>
                            <input class="col-3 float-left" type="text" name="inputConnexionLogin">
                        </div>
                        <div class="container col-12 p-0" style="height:50px;">
                            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Mot de passe</label>
                            <input class="col-2 float-left" type="password" name="inputConnexionPassword">
                        </div>
                        <div class="container col-12 p-0 pt-3">
                            <input type="submit" class="btn btn-primary" value="Connexion">
                        </div>
                        <p class="text-danger p-3"><?php if(isset($_SESSION['error'])){echo $_SESSION["error"];}; ?></p>
                    </div>
                </form>
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