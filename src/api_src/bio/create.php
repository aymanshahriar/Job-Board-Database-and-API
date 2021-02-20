<?php

/*
  In this class the create() method of the Bio class is used to create an entry in the bio table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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
if (empty($data->student_id) || empty($data->bio_stmt) || empty($data->bio_interest))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for the bio entry
  $object->student_id = $data->student_id;
  $object->bio_stmt = $data->bio_stmt;
  $object->bio_interest = $data->bio_interest;

  // create the bio entry
  if($object->create())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Bio Created"));
  }

  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Bio Not Created"));
  }
}
