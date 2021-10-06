<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function findAllUsers(){
        $this->db->query('SELECT * FROM users ' );
        $results = $this->db->resultSet();
        return $results;

    }



   
}
