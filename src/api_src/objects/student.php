<?php

/*
 * This class is used to read data from the student table of the database
 */

class Student
{
  // create variable for database connection
  private $conn;

  // create variables for table attributes
  public $user_id;
  public $student_name;
  public $student_email;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  
  // this method is used to create a new entry in the student table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Student(:student_name, :student_email)";

    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->student_name = htmlspecialchars(strip_tags($this->student_name));
    $this->student_email = htmlspecialchars(strip_tags($this->student_email));

    // bind the data
    $stmt->bindParam(":student_name",$this->student_name);
    $stmt->bindParam(":student_email",$this->student_email);

    // execute the query
    if($stmt->execute())
      return true;

    return false;
  }


}
