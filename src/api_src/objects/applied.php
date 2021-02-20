<?php

/*
 * This class is used to read data from the applied table of the database
 */

class Applied
{
  // create variable for database connection
  private $conn;

  // create variables for table attributes
  public $student_id;
  public $job_id;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  
  // this method is used to create a new entry in the applied table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Applied(:job_id, :student_id)";

    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize data
    $this->job_id = htmlspecialchars(strip_tags($this->job_id));
    $this->student_id = htmlspecialchars(strip_tags($this->student_id));

    // bind the data
    $stmt->bindParam(":job_id",$this->job_id);
    $stmt->bindParam(":student_id",$this->student_id);

    // execute query
    if($stmt->execute())
      return true;

    return false;
  }
}
