<?php

/*
  In this class the create() method of the Resume class is used to create an entry in the resume table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/resume.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();

// create a Resume object
$object = new Resume($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->student_id) || empty($data->resume_name) || empty($data->resume_education) 
    || empty($data->resume_vexp) || empty($data->resume_wexp))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for the resume entry
  $object->student_id = $data->student_id;
  $object->resume_name = $data->resume_name;
  $object->resume_education = $data->resume_education;
  $object->resume_vexp = $data->resume_vexp;
  $object->resume_wexp = $data->resume_wexp;

  // create the resume entry
  if($object->create())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Resume Created"));
  }

  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Resume Not Created"));
  }
}
