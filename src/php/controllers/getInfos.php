<?php
/**
 * Description: is showing the page for an equipment without refreshing the page
 */
session_start();
include '../models/mainModel.php';
$MainModel = new mainModel;
$response = "";
$responseOptions = "";
$infos = $MainModel->getInfosID($_POST["info"])[0];
$categories= $MainModel->getAllCategories();

//get all the categories
foreach ($categories as $element){
    $responseOptions .= '<option value="'.$element["catName"].'" id="BD" name="BD">'.$element["catName"].'</option>';
}

//adding html to answer so i can append it with jquery
$response .= 
'
    <form method="post" id="formEdit" enctype="multipart/form-data">
        <div class="container col p-0">
            <div class="container col-12 p-2" style="height:50px;">
                <label class="col-6 float-left text-right p-0 pt-1 pr-4">Type de matériel</label>
                <select id="type" name="type" class="col-3 float-left browser-default custom-select" required>
                    <option value="'.$infos["matCatName"].'" id="'.$infos["matCatName"].'" name="BD">'.$infos["matCatName"].'</option>
                    <div id="refresh">
                        '
                        .$responseOptions.
                        '
                    </div>
                </select>
                <img id ="addTypeEdit" class="pt-1 pl-2" src="../../../ressources/images/addPlus.png">
                <img id ="deleteTypeADDEdit" class="pt-1" src="../../../ressources/images/cross.png">
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Modele</label>
            <input class="col-3 float-left" type="text" name="modele" value="'.$infos["matModal"].'" required>
            </div>


            <div class="container col-12 p-0 mt-4" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Nombre (unités)</label>
            <input class="col-3 float-left" type="number" name="number" value="'.$infos["matNumber"].'" max="100" min="1" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Prix d\'achat</label>
            <input class="col-3 float-left" type="number" name="prix" value="'.$infos["matPrice"].'" max="100000" min="0" required>
            </div>


            <div class="container col-12 p-0 mt-4" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4 responsiveEquipement">Numéro de série (Fabriquant)</label>
            <input class="col-3 float-left" type="text" name="serieFabriquant" value="'.$infos["matSerialNumber"].'" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4 responsiveEquipement">Numéro de série (Perso)</label>
            <input class="col-3 float-left" type="text" name="seriePerso" value="'.$infos["matSerialPerso"].'" required>
            </div>


            <div class="container col-12 p-0 mt-4" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date de fabrication</label>
            <input class="col-3 float-left" type="date" name="dateFabrication" value="'.$infos["matFabricationDate"].'" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date d\'achat</label>
            <input class="col-3 float-left" type="date" name="dateAchat" value="'.$infos["matBoughtDate"].'" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date d\'utilisation</label>
            <input class="col-3 float-left" type="date" name="dateUtilisation" value="'.$infos["matUseDate"].'" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date de fin de vie</label>
            <input class="col-3 float-left" type="date" name="dateFinVie" value="'.$infos["matEndLifeDate"].'" required>
            </div>

            <div class="container col-12 p-0 mt-4" style="height:36px;">
                <div class="container col-6 p-0 mx-auto text-center" style="height:36px;">
                <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="EPI" value="1"';
                if($infos["matEPI"]=="1"){$response.="checked";}
                $response.='
                >Matériel EPI</label>
                <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Rebus" value="1"';
                if($infos["matRebus"]=="1"){$response.="checked";}
                $response.='
                >Rebus</label>
                <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Perdu" value="1"';
                if($infos["matLost"]=="1"){$response.="checked";}
                $response.='
                >Perdu</label>
                </div>
            </div>

            <div class="container col-12 mt-5 p-0" style="height:100%;">
            <label class="col-12 text-center p-0">Description</label>
            <textarea class="col-5 form-control mx-auto" name="description" rows="3">'.$infos["matMore"].'</textarea>
            </div>
        </div>
    </form>
    <div class="container text-center col-5 float-center p-0 mt-3" style="height:100%">
        <label class="text-danger p-0" id="getChangeErrorEdit"></label>
        <label class="text-success p-0" id="getChangeSuccessEdit"></label>
    </div>
';

echo $response;


            
