  <?php

  /*
   * This class is used to read data from the jobpost table of the database
   */

  class Jobpost
  {
    // create variable for database connection
    private $conn;

    // create variables for table attributes
    public $job_id;
    public $employer_id;
    public $job_title;
    public $job_desc;
    public $job_pdate;
    public $job_edate;
    public $job_catg;


    // constructor with $db as database connection
    public function __construct($db)
    {
      $this->conn = $db;
    }


    // this method is used to retrieve the data stored in the jobpost table
    function read_all()
    {
      // call the stored procedure query
      $sql = "CALL read_Jobpost()";

      // prepare query statement
      $stmt = $this->conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
      return $stmt;
    }


    // this method is used to create a new entry in the jobpost table
    function create()
    {
      // call the stored procedure query
      $sql = "CALL create_Jobpost(:job_title, :employer_id, :job_desc, :job_pdate, :job_edate, :job_catg)";
      
      // prepare query statement
      $stmt = $this->conn->prepare($sql);

      // sanitize the data
      $this->employer_id = htmlspecialchars(strip_tags($this->employer_id));
      $this->job_title = htmlspecialchars(strip_tags($this->job_title));
      $this->job_desc = htmlspecialchars(strip_tags($this->job_desc));
      $this->job_pdate = htmlspecialchars(strip_tags($this->job_pdate));
      $this->job_edate = htmlspecialchars(strip_tags($this->job_edate));
      $this->job_catg = htmlspecialchars(strip_tags($this->job_catg));

      // bind the data
      $stmt->bindParam(":employer_id",$this->employer_id);
      $stmt->bindParam(":job_title",$this->job_title);
      $stmt->bindParam(":job_desc",$this->job_desc);
      $stmt->bindParam(":job_pdate", $this->job_pdate);
      $stmt->bindParam(":job_edate", $this->job_edate);
      $stmt->bindParam(":job_catg", $this->job_catg);

      // execute the query
      if($stmt->execute())
        return true;

      return false;
    }


  }
