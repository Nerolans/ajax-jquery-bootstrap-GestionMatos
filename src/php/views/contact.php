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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <?php
            if(isset($_SESSION['connected']))
            {
            ?>
                <div class="col-12" style="height: 60px"></div>
                    <div class="container rounded col-8 float-center pt-3 bg-light responsiveInscription p-0" style="opacity:75%;height:550px;">
                    <h2 class="h1-responsive font-weight-bold text-center my-4">Contactez-nous</h2>
                    <!--Section description-->
                    <p class="text-center w-responsive mx-auto mb-5">Vous avez une question ou un problème à signaler? Une suggestion pour le site? N'hésitez pas à nous contacter directement via ce formulaire ou via l'adresse: epiadmin@myepi.cloud</p>

                    <form id="contactForm">
                        <div class="form-group col-6 float-center container">
                            <input type="text" class="form-control" id="contactName" placeholder="Votre nom" name="contactName">
                        </div>
                        <div class="form-group col-6 float-center container">
                            <input type="text" class="form-control" id="contactObject" placeholder="Objet" name="contactObject">
                        </div>
                        <div class="container col-6 p-0" style="">
                            <textarea class="form-control mx-auto" name="contactDescription" placeholder="Votre message" rows="3"></textarea>
                        </div>
                        <div class="container col-1 mt-3 p-0" style="">
                            <button type="button" class="btn btn-success float-center" id="buttonContact">Envoyer</button>
                        </div>
                        </form>
                        <div class="container text-center col-5 float-center p-0 mt-3" style="height:100%">
                            <label class="text-danger p-0" id="contactError"></label>
                            <label class="text-success p-0" id="contactSuccess"></label>
                        </div>
                </div>
            <?php
            }
            else
            {
                ?>
                    <div class="container text-center pt-5 col-8 float-center">
                        <p class="display-4">Vous devez vous connecter pour envoyer un message à l'administrateur</p>
                        <input type="submit" class="btn-lg mt-5 btn-secondary btn-block" value="Connexion" onclick="window.location = '../controllers/mainController.php?view=Inscription'">
                    </div>
                <?php
            } 
            ?>    
    </section>

    <!--Footer (include) founf in the "includes" folder-->
    <footer>
        <?php
        include ('includes/footer.inc.php');
        ?>
    </footer>
</body>
</html>