<?php
    class  User {
        // DB stuff
        private $conn;
        private $table = 'user';


        // User properties
        public $Email;
        public $FirstName;
        public $LastName;
        public $Age;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get User
        public function read() {
            //Create queery
            $query = 'SELECT
                        u.Email,
                        u.FirstName,
                        u.LastName,
                        u.Age
                    FROM 
                    ' . $this->table . ' u';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // create patient
        public function read_single() {
            //Create queery
            $query = 'SELECT
                        u.Email,
                        u.FirstName,
                        u.LastName,
                        u.Age
                    FROM 
                        ' . $this->table . ' u
                    WHERE u.Email = ?
                    LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind Email
            $stmt->bindParam(1, $this->Email);

            // Execute query
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->first__name = $row['FirstName'];
            $this->last__name = $row['LastName'];
            $this->Age = $row['Age'];
        }




        // Create user
        public function create() {
            // Create query
            $query = 'INSERT INTO '. $this->table . '
                    SET
                        Email = :Email,
                        FirstName = :FirstName,
                        LastName = :LastName,
                        Age = :Age';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->Email = htmlspecialchars(strip_tags($this->Email));
            $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
            $this->LastName = htmlspecialchars(strip_tags($this->LastName));
            $this->Age = htmlspecialchars(strip_tags($this->Age));

            // Bind data
            $stmt->bindParam(':Email', $this->Email);
            $stmt->bindParam(':FirstName', $this->FirstName);
            $stmt->bindParam(':LastName', $this->LastName);
            $stmt->bindParam(':Age', $this->Age);   
            
              // Execute query
            if($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }