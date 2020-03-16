<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <link href="../../../Ressources/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" href="../../../Ressources/images/favicon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Accueil</title>

</head>
<body>
    <!--Header(include)-->
    <header class="container mw-100 lighten-5">
        <?php
        include ('includes/header.inc.php');
        ?>
    </header>

    <nav class="sticky-top">
        <ul class="nav nav-tabs nav-justified sticky-top">
            <li class="nav-item">
            <a class="nav-link active" href="../controllers/mainController.php?view=Accueil">Accueil</a>
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
        <div class="container col-8 float-center text-center pt-5">
            <a class="pt-5 text-dark " style="font-size:30px;">Ce site est encore un prototype, si vous voulez nous faire part d'une amélioration, si vous trouvez un bug (même le plus petit) ou bien un moyen de passer les sécurités, veuillez, s'il vous plait, nous en faire part via la page <a href="../controllers/mainController.php?view=Contact" style="font-size:30px;" class="text-primary">Contact</a>.</a>
        </div>
        <div class="container col-8 float-center text-center pt-5">
            <a class="pt-5 text-dark " style="font-size:34px;">Cet outil vous est proposé par l'association <a href="https://www.swisscaving.guide/" target="_blank" style="font-size:34px;" class="text-primary">SwissCaving</a></a>.
        </div>
        <div class="container col-6 float-center text-center pt-5">
            <a class="pt-5 text-dark " style="font-size:30px;">Pour utiliser ce site, il vous faut tout d'abord créer un compte ou bien vous connecter à un compte existant en cliquant sur l'icône en haut à droite de l'écran. Rendez-vous ensuite dans l'onglet équipement, depuis lequel vous pourrez gérer vos équipements.</a>
        </div>
    </section>

    <!--Footer (include) founf in the "includes" folder-->
    <footer>
    </footer>
</body>
</html>