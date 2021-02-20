<?php

/*
  In this class the create() method of the Employer class is used to create an entry in the employer table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/employer.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();
$ep = new Employer($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->employer_name) || empty($data->employer_email) || empty($data->company_name) || empty($data->job_title))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing employer_name or employer_email or company_name or job_title data field"));
}
else
{
  // set the attributes for the employer entry
  $ep->employer_name = $data->employer_name;
  $ep->employer_email = $data->employer_email;
  $ep->company_name = $data->company_name;
  $ep->job_title = $data->job_title;
  
  // create the employer entry
  if($ep->create())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Employer Added"));
  }

  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Employer Not Added"));
  }
}
