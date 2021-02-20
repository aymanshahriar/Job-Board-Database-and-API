<?php

/*
  In this class the create() method of the Experience class is used to create an entry in the has_experience table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/has_experience.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();

// create Experience object
$object = new Experience($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->company_name) || empty($data->student_id))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for the has_experience entry
  $object->company_name = $data->company_name;
  $object->student_id = $data->student_id;

  // create the has_experience entry
  if($object->create())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Experience Added"));
  }
  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Experience Not Added"));
  }
}
