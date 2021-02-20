<?php

/*
 * This class is used to read data from the degree table of the database
 */

class Degree
{
  // create variable for database connection
  private $conn;

  // create variables for table attributes
  public $degree_id;
  public $student_id;
  public $degree_type;
  public $degree_subject;
  public $degree_special;
  public $uni_name;
  public $uni_location;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  
  // this method is used to create a new entry in the degree table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Degree(:student_id, :degree_type, :degree_subject, :degree_special, :uni_name, :uni_location)";
    
    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->student_id = htmlspecialchars(strip_tags($this->student_id));
    $this->degree_type = htmlspecialchars(strip_tags($this->degree_type));
    $this->degree_subject = htmlspecialchars(strip_tags($this->degree_subject));
    $this->degree_special = htmlspecialchars(strip_tags($this->degree_special));
    $this->uni_name = htmlspecialchars(strip_tags($this->uni_name));
    $this->uni_location = htmlspecialchars(strip_tags($this->uni_location));

    // bind the data
    $stmt->bindParam(":student_id",$this->student_id);
    $stmt->bindParam(":degree_type",$this->degree_type);
    $stmt->bindParam(":degree_subject", $this->degree_subject);
    $stmt->bindParam(":degree_special", $this->degree_special);
    $stmt->bindParam(":uni_name", $this->uni_name);
    $stmt->bindParam(":uni_location", $this->uni_location);

    // execute query
    if($stmt->execute())
      return true;

    return false;
  }


}
