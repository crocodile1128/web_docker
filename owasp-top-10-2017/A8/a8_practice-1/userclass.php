<?php
    class User {
        // Class data
        public $age = 0;
        public $name = '';

        // Allow object to be used as a String
        public function __toString() {
            return 'Hello ' . $this->name . ' you have ' . $this->age . ' years old. <br />';
        }
    }
?>
