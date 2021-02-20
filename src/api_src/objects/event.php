<?php

/*
 * This class is used to read data from the events table of the database
 */

class Events
{
  // create variable for database connection
  private $conn;

  // create variables for table attributes
  public $event_id;
  public $employer_id;
  public $event_title;
  public $event_date;
  public $event_desc;
 

  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }


// this method is used to create a new entry in the events table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Event(:employer_id, :event_title, :event_date, :event_desc)";

    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->employer_id = htmlspecialchars(strip_tags($this->employer_id));
    $this->event_title = htmlspecialchars(strip_tags($this->event_title));
    $this->event_date = htmlspecialchars(strip_tags($this->event_date));
    $this->event_desc = htmlspecialchars(strip_tags($this->event_desc));

    // bind the data
    $stmt->bindParam(":employer_id",$this->employer_id);
    $stmt->bindParam(":event_title",$this->event_title);
    $stmt->bindParam(":event_date", $this->event_date);
    $stmt->bindParam(":event_desc", $this->event_desc);

    // execute the query
    if($stmt->execute())
      return true;

    return false;
  }


  // this method is used to update an existing entry in the events table
  function update()
  {
    // call the stored procedure query
    $sql = "CALL update_Event(:event_id, :employer_id, :event_title, :event_date, :event_desc)";

    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->event_id = htmlspecialchars(strip_tags($this->event_id));
    $this->employer_id = htmlspecialchars(strip_tags($this->employer_id));
    $this->event_title = htmlspecialchars(strip_tags($this->event_title));
    $this->event_date = htmlspecialchars(strip_tags($this->event_date));
    $this->event_desc = htmlspecialchars(strip_tags($this->event_desc));

    // bind the data
    $stmt->bindParam(":event_id",$this->event_id);
    $stmt->bindParam(":employer_id",$this->employer_id);
    $stmt->bindParam(":event_title",$this->event_title);
    $stmt->bindParam(":event_date", $this->event_date);
    $stmt->bindParam(":event_desc", $this->event_desc);

    // execute the query
    if($stmt->execute())
      return true;

    return false;
  }

}
