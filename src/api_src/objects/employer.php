<?php

/*
 * This class is used to read data from the employer table of the database
 */

class Employer
{
  // create variable for database connection
  private $conn;

  // create variables for table attributes
  public $user_id;
  public $employer_name;
  public $employer_email;
  public $company_name;
  public $job_title;
  

  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  
// this method is used to create a new entry in the employer table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Employer(:employer_name, :employer_email, :company_name, :job_title)";
    
    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->employer_name = htmlspecialchars(strip_tags($this->employer_name));
    $this->employer_email = htmlspecialchars(strip_tags($this->employer_email));
    $this->company_name = htmlspecialchars(strip_tags($this->company_name));
    $this->job_title = htmlspecialchars(strip_tags($this->job_title));

    // bind the data
    $stmt->bindParam(":employer_name",$this->employer_name);
    $stmt->bindParam(":employer_email",$this->employer_email);
    $stmt->bindParam(":company_name",$this->company_name);
    $stmt->bindParam(":job_title",$this->job_title);

    // execute the query
    if($stmt->execute())
      return true;

    return false;
  }


}