<?php

/*
 * This class is used to read data from the resume table of the database
 */

class Resume
{
  // create variable for database connection
  private $conn;

  // create variables for table attributes
  public $student_id;
  public $resume_name;
  public $resume_education;
  public $resume_vexp;
  public $resume_wexp;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  
  // this method is used to create a new entry in the resume table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Resume(:student_id, :resume_name, :resume_education, :resume_vexp, :resume_wexp)";
    
    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->student_id = htmlspecialchars(strip_tags($this->student_id));
    $this->resume_name = htmlspecialchars(strip_tags($this->resume_name));
    $this->resume_education = htmlspecialchars(strip_tags($this->resume_education));
    $this->resume_vexp = htmlspecialchars(strip_tags($this->resume_vexp));
    $this->resume_wexp = htmlspecialchars(strip_tags($this->resume_wexp));

    // bind the data
    $stmt->bindParam(":student_id",$this->student_id);
    $stmt->bindParam(":resume_name",$this->resume_name);
    $stmt->bindParam(":resume_education",$this->resume_education);
    $stmt->bindParam(":resume_vexp", $this->resume_vexp);
    $stmt->bindParam(":resume_wexp", $this->resume_wexp);

    // execute the query
    if($stmt->execute())
      return true;

    return false;
  }


}
