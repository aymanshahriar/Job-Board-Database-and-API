<?php

/*
  In this class the create() method of the Applied class is used to create an entry in the applied table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/applied.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();
$object = new Applied($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->job_id) || empty($data->student_id))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for applied entry
  $object->job_id = $data->job_id;
  $object->student_id = $data->student_id;

  // create the applied entry
  if($object->create())
  {
    
    http_response_code(201);
    echo json_encode(array('message'=>"Application Submitted"));
  }

  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Application Not Submitted"));
  }
}
