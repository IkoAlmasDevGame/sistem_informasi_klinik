<?php 
    namespace model;

    class Docter {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }
    }
?>