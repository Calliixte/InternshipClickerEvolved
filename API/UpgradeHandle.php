<?php

require_once('db.php');
class UpgradeHandle
{

//On ne modifiera pas les upgrades pendant la partie donc on a juste besoin d'un select * pour le JSON
//le JSON est récupéré mais ensuite les données sont gérées a partir du JSON en local (on pourrait ne pas mettre cost et amount bought et les rajouter par la suite en js à vrai dire)
public static function handleGet($params){    
    $db = new myDB();
    $result = $db->query('SELECT * FROM upgrade');
    while($row = $result -> fetchArray()){
        $ar[] = array("id"=>$row["id_upgrade"],"title"=>$row["title"],"subtitle"=>$row["subtitle"],"effect_description"=>$row["effect_description"],"called_method"=>$row["called_method"],"cost"=>$row["cost"],"baseCost"=>$row["baseCost"],"amountBought"=>$row["amountBought"]);   
    }
    return $ar;
}

}


?>