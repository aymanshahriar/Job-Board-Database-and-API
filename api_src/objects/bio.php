<?php

/*
 * This class is used to read data from the bio table of the database
 */

class Bio
{
  // create variable for database connection 
  private $conn;

  // create variables with table attributes
  public $bio_id;
  public $student_id;
  public $bio_stmt;
  public $bio_interest;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }


  function read_single()
  {
    $sql = " CALL read_single_Bio(:id)";
    $stmt = $this->conn->prepare($sql);
    $this->bio_id = htmlspecialchars(strip_tags($this->bio_id));
    $stmt->bindParam(":id",$this->bio_id);
    if($stmt->execute() && $stmt->rowCount()>0)
    {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->student_id = $row["student_id"];
      $this->bio_stmt = $row["bio_stmt"];
      $this->bio_interest = $row["bio_interest"];
      return true;
    }
    return false;
  }

  
  // this method is used to create a new entry in the bio table
  function create()
  {
    // call the stored procedure query
    $sql = "CALL create_Bio(:student_id, :bio_stmt, :bio_interest)";

    // prepare query statement
    $stmt = $this->conn->prepare($sql);

    // sanitize the data
    $this->student_id = htmlspecialchars(strip_tags($this->student_id));
    $this->bio_stmt = htmlspecialchars(strip_tags($this->bio_stmt));
    $this->bio_interest = htmlspecialchars(strip_tags($this->bio_interest));

    // bind the data
    $stmt->bindParam(":student_id",$this->student_id);
    $stmt->bindParam(":bio_stmt",$this->bio_stmt);
    $stmt->bindParam(":bio_interest", $this->bio_interest);

    // execute query
    if($stmt->execute())
      return true;

    return false;
  }

}
