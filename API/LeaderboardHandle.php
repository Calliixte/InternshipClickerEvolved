<?php

require_once('db.php');
class LeaderboardHandle
{
public static function handleGet($params){    
    $db = new myDB();
    $result = $db->query("SELECT * FROM leaderboard l ORDER BY SCORE DESC"); //trié par défaut comme ça pas besoin de le faire en front
    while($row = $result -> fetchArray()){
        $ar[] = array("id_lb"=>$row["id_lb"],"user_name"=>$row["user_name"],"score"=>$row["score"]);   
    }
    return $ar;
}

public static function handlePost($body){
    $db = new myDB();
    $stmt = $db->prepare("INSERT INTO leaderboard (user_name,score) VALUES (:user_name,:score)");
    $stmt->bindValue(':user_name',$body['user_name'],SQLITE3_TEXT);
    $stmt->bindValue(':score',$body['score'],SQLITE3_FLOAT);
    
    $result = $stmt->execute();
    return $result;


}
public static function handlePut(){
    //faire un truc imbriqué ou y'a un array des where et un array 
    //ou alors juste pas de put en vrai y'a aucune raison qu'on modifie un utilisateur c'est juste un nom
    echo "put leaderboards";
}

public static function handleDelete($id){
    $id = (int) $id;
    $db = new myDB();
    $stmt = $db->prepare("DELETE FROM leaderboard WHERE id_lb=:id");
    $stmt->bindValue(':id',$id,SQLITE3_INTEGER);

    $result = $stmt->execute();
    return $result;

}
}


?>