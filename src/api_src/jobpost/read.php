<?php

/*
  In this class the read() method of the Jobpost class is used to create an entry in the jobpost table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
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
$stmt = $jp->read_all();
$numRow = $stmt->rowCount();

// check if the jobpost table is empty
if($numRow>0)
{
  // is the jobpost table contains entries, create an array that contains those entries
  $job_array = array();
  $job_array["Job Posts"] = array();

  // retrieve each entry in the bio table one by one
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    // format each entry into the job_array
    extract($row);
    $post = array("ID"=>$job_id,"Title"=>$job_title,"Description"=>html_entity_decode($job_desc),
    "Category"=>$job_catg,"Date Posted"=>$job_pdate,"Expiration Date"=>$job_edate);
    array_push($job_array["Job Posts"],$post);
  }
  // set response code to be 200 OK
  http_response_code(200);
  // return the array in json format
  echo json_encode($job_array);
}

// if the jobpost table is empty, notify the user
else
{
  http_response_code(404);
  echo json_encode(array("message" => "No Job Posts Found"));
}
