<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../model/album.php';

$database = new Database();
$db = $database->getConnection();
 
$album = new Album($db);
 
$stmt = $album->read();
$num = $stmt->rowCount();

if($num>0){
 
    $albums_arr=array();
    $albums_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
 
        $album_item=array(
            "id" => $id,
            "title" => $title,
            "cover" => $cover,
            "musician" => $musician
        );
 
        array_push($albums_arr["records"], $album_item);
    }
 
    http_response_code(200);

    echo json_encode($albums_arr);
}
else
{
    http_response_code(404);

    echo json_encode(
        array("message" => "No albums found.")
    );
}


?>