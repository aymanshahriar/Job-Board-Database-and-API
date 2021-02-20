<?php

/*
  In this class the create() method of the Degree class is used to create an entry in the degree table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/degree.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();
$object = new Degree($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->student_id) || empty($data->degree_type) || empty($data->uni_name) || empty($data->uni_location))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for the degree entry
  $object->student_id = $data->student_id;
  $object->degree_type = $data->degree_type;
  $object->degree_subject = $data->degree_subject;
  $object->degree_special = $data->degree_special;
  $object->uni_name = $data->uni_name;
  $object->uni_location = $data->uni_location;


  // create the degree entry
  if($object->create())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Degree Created"));
  }

  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Degree Not Created"));
  }
}
