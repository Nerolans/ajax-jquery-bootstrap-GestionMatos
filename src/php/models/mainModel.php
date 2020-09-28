<?php
/**
 * Descriprion: page where infos gat to communicate with the DB
 */
class mainModel
{
    private $connector;

    //CONNECT / UNCONNECT / EXECUTESQL/////////////

    //connect to DB
    private function dbConnect()
    {
        $this->connector = new PDO('mysql:host=localhost:8889;dbname=p_matos','root','root');
    }

    //execute the query and getting the result
    private function executeGetRequestSQL($query)
    {
        $this->dbConnect();
        $req = $this->connector->query($query)->fetchAll(PDO::FETCH_ASSOC);
        $this->dbUnconnect();
        return $req;
    }

    //execute the query
    private function executeRequestSQL($query)
    {
        $this->dbConnect();
        $this->connector->query($query);
        $this->dbUnconnect();
    }

    //deconnect from the DB
    private function dbUnconnect()
    {
        unset($this->connector);
    }

    public function getAllCategories()
    {
        $query ='SELECT t_category.catName FROM `t_category` UNION SELECT t_persocategory.catName FROM `t_persocategory` WHERE t_persocategory.idUser = "'.$_SESSION["idUser"][0]["idUser"].'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }
    public function getPersoCategories()
    {
        $query ='SELECT t_persocategory.catName FROM `t_persocategory` WHERE t_persocategory.idUser = "'.$_SESSION["idUser"][0]["idUser"].'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function getMainInfos()
    {
        $query = 'SELECT `matModal`,`matSerialPerso`,`matRebus`,`catName` FROM `t_matos`INNER JOIN `t_category` ON t_matos.idCategory = t_category.idCategory WHERE `idUser` = "'.$_SESSION["idUser"][0]["idUser"].'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function checkPseudo($toSearch)
    {
        $query = 'SELECT `useOrganisation`FROM `t_user` WHERE `useOrganisation` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        //return null si inexistant
        return $result;
    }

    public function checkMail($toSearch)
    {
        $query = 'SELECT `useMail` FROM `t_user` WHERE `useMail` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        //return null si inexistant
        return $result;
    }

    public function addUser($pseudo, $mail, $password)
    {
        $query = 'INSERT INTO t_user (UsePassword, UseAdmin, UseOrganisation, UseMail) VALUES ("'.$password.'",0,"'.$pseudo.'","'.$mail.'")';
        $this->executeRequestSQL($query);
    }

    public function GetIdByUsername($toSearch)
    {
        $query = 'SELECT `idUser` FROM `t_user` WHERE `useOrganisation` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function GetIdByMail($toSearch)
    {
        $query = 'SELECT `idUser` FROM `t_user` WHERE `useMail` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function GetMailbyID($toSearch)
    {
        $query = 'SELECT `useMail` FROM `t_user` WHERE `idUser` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    } 
    
    public function GetUserInfo($toSearch)
    {
        $query= 'SELECT `useOrganisation`,`useMail` FROM `t_user` WHERE `idUser` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function searchPasswordMail($toSearch)
    {
        $query = 'SELECT `UsePassword` FROM `t_user` WHERE `UseMail` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result[0];
    }

    public function searchPasswordID($toSearch)
    {
        $query = 'SELECT `UsePassword` FROM `t_user` WHERE `idUser` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result[0];
    }

    public function modifUser($toSearch)
    {
        $query = 'UPDATE t_user SET UseOrganisation = "'.$toSearch.'" WHERE idUser = "'.$_SESSION["idUser"][0]["idUser"].'"';
        $this->executeRequestSQL($query);
    }

    public function addPersoType($toAdd, $id)
    {
        $query = 'INSERT INTO t_persocategory (catName, idUser) VALUES ("'.$toAdd.'","'.$id.'")';
        $this->executeRequestSQL($query);
    }

    #Finish Here
    public function addEquipment($matType, $matModal, $matNumber, $matprice, $matSerialNumber, $matSerialPerso, $matFabricationDate, $matBoughtDate, $matUseDate, $matEndLifeDate, $matEPI, $matRebus, $matLost, $matMore, $idUser)
    {
        $query = 'INSERT INTO t_matos (matCatName,matModal,matNumber,matPrice,matSerialNumber,matSerialPerso,matFabricationDate,matBoughtdate,matUseDate,matEndLifeDate, matEPI, matRebus,matLost,matMore,idUser,idCategory) VALUES ("'.$matType.'","'.$matModal.'","'.$matNumber.'","'.$matprice.'","'.$matSerialNumber.'","'.$matSerialPerso.'","'.$matFabricationDate.'","'.$matBoughtDate.'","'.$matUseDate.'","'.$matEndLifeDate.'","'.$matEPI.'","'.$matRebus.'","'.$matLost.'","'.$matMore.'","'.$idUser.'",1)';
        $this->executeRequestSQL($query);
        $query = 'SELECT idMatos FROM t_matos WHERE idUser = "'.$idUser.'" ORDER BY idMatos DESC LIMIT 1';
        $return = $this->executeGetRequestSQL($query);
        return $return;
    }

    public function modifEquipment($matType, $matModal, $matNumber, $matprice, $matSerialNumber, $matSerialPerso, $matFabricationDate, $matBoughtDate, $matUseDate, $matEndLifeDate, $matEPI, $matRebus, $matLost, $matMore, $idMatos, $idUser)
    {
        $query = 'UPDATE t_matos SET matcatName="'.$matType.'", matModal="'.$matModal.'", matNumber="'.$matNumber.'", matPrice="'.$matprice.'", matSerialNumber="'.$matSerialNumber.'", matSerialPerso="'.$matSerialPerso.'", matFabricationDate="'.$matFabricationDate.'", matBoughtDate="'.$matBoughtDate.'", matUseDate="'.$matUseDate.'", matEndLifeDate="'.$matEndLifeDate.'", matEPI="'.$matEPI.'", matRebus="'.$matRebus.'", matLost="'.$matLost.'", matMore="'.$matMore.'" WHERE idMatos= "'.$idMatos.'" AND idUser="'.$idUser.'"';
        $this->executeRequestSQL($query);
    }
    
    public function getIdCat($toSearch)
    {
        $query = 'SELECT `idCategory` FROM `t_category` WHERE `catName` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result[0];
    }

    public function getBasicInfos($idUser)
    {
        $query = 'SELECT * FROM `t_matos` WHERE `idUser` = "'.$idUser.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function getInfosID($toSearch)
    {
        
        $query = 'SELECT * FROM `t_matos` WHERE `idMatos` = "'.$toSearch.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function deleteEquipment($idUser, $idMatos)
    {
        $query = 'DELETE FROM t_matos WHERE `idUser` = "'.$idUser.'" AND `idMatos` = "'.$idMatos.'"';
        $this->executeRequestSQL($query);
    }

    public function deleteType($idUser, $typeName)
    {
        $query = 'DELETE FROM t_persocategory WHERE `idUser` = "'.$idUser.'" AND `catName` = "'.$typeName.'"';
        $this->executeRequestSQL($query);
    }

    public function setTokenInfos($selector,$hashedToken, $expires, $idUser)
    {
        $query = 'UPDATE t_user SET useResetSelector = "'.$selector.'", useResetToken = "'.$hashedToken.'", useResetExpires = "'.$expires.'" WHERE idUser = "'.$idUser[0]["idUser"].'"';
        $this->executeRequestSQL($query);
    }

    public function getToken($selector, $date)
    {    
        $query = 'SELECT * FROM `t_user` WHERE `useResetSelector` = "'.$selector.'" AND `useResetExpires` >= "'.$date.'"';
        $result = $this->executeGetRequestSQL($query);
        return $result;
    }

    public function changePassword($validator, $password)
    {    
        $query = 'UPDATE t_user SET UsePassword = "'.$password.'" WHERE useResetSelector = "'.$validator.'"';
        $result = $this->executeRequestSQL($query);
    }
}