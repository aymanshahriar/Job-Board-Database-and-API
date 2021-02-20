<?php

/*
  In this class the create() method of the Student class is used to create an entry in the student table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/student.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();
$jp = new Student($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->student_name) || empty($data->student_email))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for student entry
  $jp->student_name = $data->student_name;
  $jp->student_email = $data->student_email;

  // create the new student entry
  if($jp->create())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Student Added"));
  }
  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Student Not Added"));
  }
}
