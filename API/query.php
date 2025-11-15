<?php

include('DB.php');

$db = new myDB();
$result = $db->query('SELECT * FROM user');
while($row = $result -> fetchArray()){
    $ar[] = array("id"=>$row["id_user"],"name"=>$row["name"]);   
}

?>
<?php print_r($ar) ?>