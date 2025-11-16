<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' ||$method === 'DELETE') {            
    $table = $_GET["table"] ?? null;
    if($method === 'DELETE'){
        if($_GET["id"]){
            $id=$_GET["id"] ?? null;
        }
        else{
            http_response_code(400);
            echo json_encode(["error" => "Paramètre 'id' manquant pour une requete DELETE"]);
            exit;
        }
    }
} else {                                                        //Pour la table a utiliser si jamais la requete est get le nom de la table est en url et si jamais c'est un autre type de requete
    $input = json_decode(file_get_contents('php://input'), true);
    $table = $input["table"] ?? null;
}

if (!$table) {
    http_response_code(400);
    echo json_encode(["error" => "Paramètre 'table' manquant"]);
    // var_dump($input);
    exit;
}


$table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
$tableName = $table . "Handle";
$path =$tableName . ".php";

if (!file_exists($path)) {
    http_response_code(404);
    echo json_encode(["error" => "Handler introuvable : $path"]);
    exit;
}

require_once($path);
$response;
switch ($method) {
    case 'GET':
        $response = $tableName::handleGet($_GET);
        break;
    case 'POST':
        $response = $tableName::handlePost($input);
        break;
    case 'PUT':
        $response = $tableName::handlePut($input);   
        break;
    case 'DELETE':
        $response = $tableName::handleDelete($id);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}
echo json_encode($response,JSON_PRETTY_PRINT);

?>