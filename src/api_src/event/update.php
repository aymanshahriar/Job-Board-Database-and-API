<?php

/*
  In this class the update() method of the Event class is used to update an existing entry in the events table
*/

// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With");

// get database connection
include_once '../config/dbconnect.php';

// instantiate an applied object
include_once '../objects/event.php';

// connect to database
$database = new DBconnect();
$db = $database->connect();

// create Events obect
$object = new Events($db);

// retrieve posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (empty($data->event_id) || empty($data->employer_id) || empty($data->event_title) || empty($data->event_desc) || empty($data->event_date))
{
  http_response_code(400);
  echo json_encode(array("message" => "Missing data field"));
}
else
{
  // set the attributes for the Event object
  $object->event_id = $data->event_id;
  $object->employer_id = $data->employer_id;
  $object->event_title = $data->event_title;
  $object->event_desc = $data->event_desc;
  $object->event_date = $data->event_date;

  // update the applied entry
  if($object->update())
  {
    http_response_code(201);
    echo json_encode(array('message'=>"Events Updated"));
  }
  // if unable to update the entry, tell the user
  else
  {
    http_response_code(503);
    echo json_encode(array('message'=>"Error: Events Not Updated"));
  }
}
