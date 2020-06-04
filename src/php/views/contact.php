<!--
    Create by : Guillaume Hyvert
    Date : 03.05.2019
    Description : page where the user can contact the administrator of the website
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
    <title>Contact</title>

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
            <a class="nav-link" href="../controllers/mainController.php?view=Equipement">Mon équipement</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="../controllers/mainController.php?view=Contact">Contact</a>
            </li>
        </ul>
        <div id="underNav" class="container col-12 pt-2">
    </nav>

    <!--Content of the page-->
    <section>
                    
    </section>

    <!--Footer (include) founf in the "includes" folder-->
    <footer>
        <?php
        include ('includes/footer.inc.php');
        ?>
    </footer>
</body>
</html>