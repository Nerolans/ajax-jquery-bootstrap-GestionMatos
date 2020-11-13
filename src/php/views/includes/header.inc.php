<div class="row">
    <div class="col-1"></div>
    <div class="container col">
        <h1 class="text-right pt-4 headertext">Gestion</h1>
    </div>
    <div class="container-">
        <a href="../../php/controllers/mainController.php?view=Accueil"><img src="../../../ressources/images/logo.png" class="img-md mx-auto d-block" alt="main image of the website"></a>
    </div>
    <div class="container-fluid col">
        <h1 class="text-left pt-4 headertext">Matériel</h1>
    </div>
    <div class="container col-1 p-0">
    <?php if($_SESSION["connected"] != true){?>       
        <a href="../../php/controllers/mainController.php?view=Inscription"><img src="../../../ressources/images/userN.png" id="connect" class="img-fluid d-block pt-3 mr-1 float-right" alt="image to connect"></a>
    <?php }else{?>
        <a href="../../php/controllers/mainController.php?view=Settings"><img src="../../../ressources/images/userY.png" id="connect" class="img-fluid d-block pt-3 mr-1 float-right" alt="image to connect"></a>
    <?php }?>
    </div>
</div>
<form action="https://www.paypal.com/donate" style="width:108px;" class="mx-auto pb-2" method="post" target="_top" data-toggle="tooltip" data-placement="bottom" title="Si vous aimez utiliser ce site, supportez-le en faisant un don !">
    <input type="hidden" name="hosted_button_id" value="TCH5WXNGMXE42" />
    <input type="image" src="https://www.paypalobjects.com/fr_FR/CH/i/btn/btn_donate_SM.gif" target="_blank" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/fr_CH/i/scr/pixel.gif" width="1" height="1" />
</form>
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

