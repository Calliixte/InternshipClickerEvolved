<?php

require_once('db.php');
class UserHandle
{
public static function handleGet($params){
    //default select * voir pour select par nom ou quoi dans l'url
    
    $db = new myDB();
    $result = $db->query('SELECT * FROM user');
    while($row = $result -> fetchArray()){
        $ar[] = array("id"=>$row["id_user"],"name"=>$row["name"]);   
    }
    return $ar;
}

public static function handlePost($body){
    $db = new myDB();
    $stmt = $db->prepare("INSERT INTO user VALUES (:id,:name)");
    $stmt->bindValue(':id',$body['id'],SQLITE3_INTEGER);
    $stmt->bindValue(':name',$body['name'],SQLITE3_TEXT);    

    $result = $stmt->execute();
    return $result;


}
public static function handlePut(){
    //faire un truc imbriqué ou y'a un array des where et un array 
    //ou alors juste pas de put en vrai y'a aucune raison qu'on modifie un utilisateur c'est juste un nom
    echo "put users";
}

public static function handleDelete($id){
    $id = (int) $id;
    $db = new myDB();
    $stmt = $db->prepare("DELETE FROM user WHERE id_user=:id");
    $stmt->bindValue(':id',$id,SQLITE3_INTEGER);

    $result = $stmt->execute();
    return $result;

}
}


?>