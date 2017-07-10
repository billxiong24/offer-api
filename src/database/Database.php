<?php
    namespace Offer\database;
    class Database {

        private $database;
        public function __construct($database) {
            $this->database = $database;
        }

        public function query($query, $obj) {
            $stmt = $this->database->prepare($query);

            $query_result = $stmt->execute($obj);
            if($query_result) {
                return $stmt;
            }

            //throw exception or soemthing 
            return null;
        }
    }
?>
