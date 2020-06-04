<?php
/**
 * Created by PhpStorm.
 * User: hyvertgu
 * Date: 22.03.2019
 * Time: 11:39
 */
class mainModel
{
    private $connector;

    //CONNECT / UNCONNECT / EXECUTESQL/////////////

    private function dbConnect()
    {
        $this->connector = new PDO('mysql:host=localhost:8889;dbname=p_matos','root','root');
    }

    private function executeGetRequestSQL($query)
    {
        $this->dbConnect();
        $req = $this->connector->query($query)->fetchAll(PDO::FETCH_ASSOC);
        $this->dbUnconnect();
        return $req;
    }

    private function executeRequestSQL($query)
    {
        $this->dbConnect();
        $this->connector->query($query);
        $this->dbUnconnect();
    }

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
}