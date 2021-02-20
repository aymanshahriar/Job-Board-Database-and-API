<?php

/*
 * This class is used to read data from the has_experience table of the database
 */

class Experience
{
  // Create variable for database connection
  private $conn;

  // create variables for table attributes
  public $student_id;
  public $company_name;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  
  // this method is used to create a new entry in the has_experience table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Has_Experience(:company_name, :student_id)";

    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->company_name = htmlspecialchars(strip_tags($this->company_name));
    $this->student_id = htmlspecialchars(strip_tags($this->student_id));

    // bind the data
    $stmt->bindParam(":company_name",$this->company_name);
    $stmt->bindParam(":student_id",$this->student_id);

    // execute the query
    if($stmt->execute())
      return true;

    return false;
  }
}
