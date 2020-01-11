<?php
    class TrainingSession {
        // DB stuff
        private $conn;
        private $table = "TrainingSession";

        // TrainingSession properties
        public $SessionId;
        public $SessionDate; 
        public $PatientId;
        public $NrOfGoodCorrectImages;
        public $NrOfGoodWrongImages;
        public $NrOfBadCorrectImages;
        public $NrOfBadWrongImages;
        public $ElapsedTime;
        public $IsTrainingCompleted;
        public $IsDataSent;

         // Constructor with DB

         public function __construct($db) {
            $this->conn = $db;
        }

        // Get TrainingSession
        public function read() {
            //Create query
             $query = "SELECT 
                        t.SessionId, 
                        t.SessionDate, 
                        t.PatientId,
                        t.NrOfGoodCorrectImages,
                        t.NrOfGoodWrongImages,
                        t.NrOfBadCorrectImages,
                        t.NrOfBadWrongImages,
                        t.ElapsedTime,
                        t.IsTrainingCompleted,
                        t.IsDataSent
                    FROM
                    " .$this->table. " t ";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt -> execute();

            return $stmt;
        }


         // Create TrainingSession
         public function create() {
            // Create query
            $query = 'INSERT INTO '. $this->table . '
                    SET
                        SessionId = :SessionId,
                        SessionDate = :SessionDate,
                        PatientId = :PatientId,
                        NrOfGoodCorrectImages = :NrOfGoodCorrectImages,
                        NrOfGoodWrongImages = :NrOfGoodWrongImages,
                        NrOfBadCorrectImages = :NrOfBadCorrectImages,
                        NrOfBadWrongImages = :NrOfBadWrongImages,
                        ElapsedTime = :ElapsedTime,
                        IsTrainingCompleted = :IsTrainingCompleted,
                        IsDataSent = :IsDataSent';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->SessionId = htmlspecialchars(strip_tags($this->SessionId));
            $this->SessionDate = htmlspecialchars(strip_tags($this->SessionDate));
            $this->PatientId = htmlspecialchars(strip_tags($this->PatientId));
            $this->NrOfGoodCorrectImages = htmlspecialchars(strip_tags($this->NrOfGoodCorrectImages));
            $this->NrOfGoodWrongImages = htmlspecialchars(strip_tags($this->NrOfGoodWrongImages));
            $this->NrOfBadCorrectImages = htmlspecialchars(strip_tags($this->NrOfBadCorrectImages));
            $this->NrOfBadWrongImages = htmlspecialchars(strip_tags($this->NrOfBadWrongImages));
            $this->ElapsedTime = htmlspecialchars(strip_tags($this->ElapsedTime));
            $this->IsTrainingCompleted = htmlspecialchars(strip_tags($this->IsTrainingCompleted));
            $this->IsDataSent = htmlspecialchars(strip_tags($this->IsDataSent));
        


            // Bind data
            $stmt->bindParam(':SessionId', $this->SessionId);
            $stmt->bindParam(':SessionDate', $this->SessionDate);
            $stmt->bindParam(':PatientId', $this->PatientId);
            $stmt->bindParam(':NrOfGoodCorrectImages', $this->NrOfGoodCorrectImages);  
            $stmt->bindParam(':NrOfGoodWrongImages', $this->NrOfGoodWrongImages);
            $stmt->bindParam(':NrOfBadCorrectImages', $this->NrOfBadCorrectImages);
            $stmt->bindParam(':NrOfBadWrongImages', $this->NrOfBadWrongImages);
            $stmt->bindParam(':ElapsedTime', $this->ElapsedTime);  
            $stmt->bindParam(':IsTrainingCompleted', $this->IsTrainingCompleted);
            $stmt->bindParam(':IsDataSent', $this->IsDataSent);  
            
              // Execute query
            if($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }