<?php
/**
 * Description: is showing the page for an equipment without refreshing the page (ongoing)
 */
session_start();
include '../models/mainModel.php';
$MainModel = new mainModel;
$id = "25";
$response = "";

$infos = $MainModel->getInfosID($_POST);
$categories= $MainModel->getAllCategories();
print_r($_POST);

$response .= '<form method="post" id="formADD" enctype="multipart/form-data"><div class="container col p-0"><div class="container col-12 p-2" style="height:50px;"><label class="col-6 float-left text-right p-0 pt-1 pr-4">Type de matériel</label><select id="type" name="type" class="col-3 float-left browser-default custom-select" required><option value="void" id="void" name="void"></option><div id="refresh">';
foreach ($categories as $element){
    $response .= '<option value="'.$element["catName"].'" id="BD" name="BD">'.$element["catName"].'</option>;';
}
$response .= '</div></select></div><div class="container col-12 p-0" style="height:36px;"><label class="col-6 float-left text-right p-0 pt-1 pr-4">Modele</label>';
$response .= '<input class="col-3 float-left" type="text" name="modele" value="<?php echo $info[\'catModal\'] ?>" required></div>
            <div class="container col-12 p-0 mt-4" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Nombre (unités)</label>
            <input class="col-3 float-left" type="number" name="number" value="1" max=\'100\' min="1" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Prix d\'achat</label>
            <input class="col-3 float-left" type="number" name="prix" value="0" max=\'100000\' min="0" required>
            </div>


            <div class="container col-12 p-0 mt-4" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4 responsiveEquipement">Numéro de série (Fabriquant)</label>
            <input class="col-3 float-left" type="text" name="serieFabriquant" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4 responsiveEquipement">Numéro de série (Perso)</label>
            <input class="col-3 float-left" type="text" name="seriePerso" required>
            </div>


            <div class="container col-12 p-0 mt-4" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date de fabrication</label>
            <input class="col-3 float-left" type="date" name="dateFabrication" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date d\'achat</label>
            <input class="col-3 float-left" type="date" name="dateAchat" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date d\'utilisation</label>
            <input class="col-3 float-left" type="date" name="dateUtilisation" required>
            </div>

            <div class="container col-12 p-0" style="height:36px;">
            <label class="col-6 float-left text-right p-0 pt-1 pr-4">Date de fin de vie</label>
            <input class="col-3 float-left" type="date" name="dateFinVie" required>
            </div>

            <div class="container col-12 p-0 mt-4" style="height:36px;">
                <div class="container col-6 p-0 mx-auto text-center" style="height:36px;">
                <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="EPI" value="1">Matériel EPI</label>
                <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Rebus" value="1">Rebus</label>
                <label class="checkbox-inline p-0 pt-1"><input type="checkbox" name="Perdu" value="1">Perdu</label>
                </div>
            </div>

            <div class="container col-12 mt-5 p-0" style="height:100%;">
            <label class="col-12 text-center p-0">Description</label>
            <textarea class="col-5 form-control mx-auto" name="description" rows="3"></textarea>
            </div>
        </div>
    </form>
    <div class="container text-center col-5 float-center p-0 mt-3" style="height:100%">
        <label class="text-danger p-0" id="getChangeError"></label>
        <label class="text-success p-0" id="getChangeSuccess"></label>
    </div>';


            
