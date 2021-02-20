<?php

/*
  In this class the read_single() method of the Applied class is used to read 
  a single entry from the  the bio table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/bio.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();
$object = new Bio($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->bio_id))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing bio_id field"));
}
else
{ // set the bio_id specified by the user
  $object->bio_id = $data->bio_id;

  // read the bio that matches the specified bio_id
  if($object->read_single())
  { 
    // return the details of the bio in json format
    $bio_array = array();
    $bio_array["Bio"] = array();

    $post = array("Bio ID"=>$object->bio_id,"Student ID"=>$object->student_id,"Statement"=>html_entity_decode($object->bio_stmt),
    "Interests"=>html_entity_decode($object->bio_interest));
    array_push($bio_array["Bio"],$post);

    http_response_code(200);
    echo json_encode($bio_array);
  }
  // if unable to read the entry, tell the user
  else
  {
    http_response_code(404);
    echo json_encode(array("message" => "Bio Not Found"));
  }
}
