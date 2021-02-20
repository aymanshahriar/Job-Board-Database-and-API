<?php

/*
  In this class the create() method of the Jobpost class is used to create an entry in the jobpost table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/jobpost.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();

// create Jobpost object
$jp = new Jobpost($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->job_title) || empty($data->job_desc) || empty($data->job_catg) || empty($data->employer_id))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for the jobpost entry
  $jp->employer_id = $data->employer_id;
  $jp->job_title = $data->job_title;
  $jp->job_desc = $data->job_desc;
  $jp->job_pdate = date('Y-m-d H:i:s',time());
  $jp->job_edate = date("Y-m-d H:i:s",strtotime("+30 days",time()));
  $jp->job_catg = $data->job_catg;

  // create the jobpost entry
  if($jp->create())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Job Post Created"));
  }
  // if unable to create the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Job Post Not Created"));
  }
}
