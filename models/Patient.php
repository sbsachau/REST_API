<?php
    class Patient {
        //DB stuff
        private $conn;
        private $table ='patient';

        // Patient properties
        public $PatientId;
        public $DataToSent;
        public $Email;

        // Constructor with DB

        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Patients
        public function read() {
            //Create query
            $query = "SELECT 
                        p.PatientId,
                        p.DataToSent,
                        p.Email
                    FROM
                    " .$this->table. " p ";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt -> execute();

            return $stmt;
        }

        // Get Patients
        public function read_single() {
            //Create query
            $query = "SELECT 
                        p.PatientId,
                        p.DataToSent,
                        p.Email
                    FROM
                    " .$this->table. " p 
                     WHERE p.Email = ?
                     LIMIT 0,1";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind Email
            $stmt->bindParam(1, $this->Email);

            // Execute query
            $stmt -> execute();

            // fetch the array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->PatientId = $row['PatientId'];
            $this->DataToSent = $row['DataToSent'];
            $this->Email = $row['Email'];

        }

         // Create user
         public function create() {
            // Create query
            $query = 'INSERT INTO '. $this->table . '
                    SET
                        DataToSent = :DataToSent,
                        Email = :Email';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // // Clean data
            // $this->DataToSent = htmlspecialchars(strip_tags($this->DataToSent));
            // $this->Email = htmlspecialchars(strip_tags($this->Email));

            // Bind data
            $stmt->bindParam(':DataToSent', $this->DataToSent);
            $stmt->bindParam(':Email', $this->Email);
            
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
         
    }