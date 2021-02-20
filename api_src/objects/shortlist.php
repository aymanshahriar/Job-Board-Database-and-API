<?php

/*
 * This class is used to read data from the shortlist table of the database
 */

class Shortlist
{
  // create variable for database connection
  private $conn;

  // create variables for table attributes
  public $employer_id;
  public $student_id;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  
  // this method is used to create a new entry in the shortlist table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Shortlist(:employer_id, :student_id)";
    
    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->employer_id = htmlspecialchars(strip_tags($this->employer_id));
    $this->student_id = htmlspecialchars(strip_tags($this->student_id));

    // bind the data
    $stmt->bindParam(":employer_id",$this->employer_id);
    $stmt->bindParam(":student_id",$this->student_id);

    // execute the query
    if($stmt->execute())
      return true;

    return false;
  }

  
}
