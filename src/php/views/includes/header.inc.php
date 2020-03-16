<div class="row">
    <div class="col-1"></div>
    <div class="container col">
        <h1 class="text-right pt-4 headertext">Gestion</h1>
    </div>
    <div class="container-">
        <a href="../../php/Controllers/mainController.php?view=Accueil"><img src="../../../ressources/images/logo.png" class="img-md mx-auto d-block" alt="main image of the website"></a>
    </div>
    <div class="container-fluid col">
        <h1 class="text-left pt-4 headertext">Matériel</h1>
    </div>
    <div class="container col-1 p-0">
    <?php if($_SESSION["connected"] != true){?>       
        <a href="../../php/Controllers/mainController.php?view=Inscription"><img src="../../../ressources/images/userN.png" id="connect" class="img-fluid d-block pt-3 mr-1 float-right" alt="image to connect"></a>
    <?php }else{?>
        <a href="../../php/Controllers/mainController.php?view=Settings"><img src="../../../ressources/images/userY.png" id="connect" class="img-fluid d-block pt-3 mr-1 float-right" alt="image to connect"></a>
    <?php }?>
    </div>
</div>

<?php
if($_SESSION["connected"] != true)
{
   ?>
        <script>
        $(document).ready(function(){

        $('#connect').hover(function(){
            $(this).attr("src","../../../ressources/images/userN2.png");
        }, function(){$(this).attr("src","../../../ressources/images/userN.png");});

        });
        </script>
   <?php 
}
else
{
    ?>
        <script>
        $(document).ready(function(){

        $('#connect').hover(function(){
            $(this).attr("src","../../../ressources/images/userY2.png");
        }, function(){$(this).attr("src","../../../ressources/images/userY.png");});

        });
        </script>
    <?php 
}
?>

