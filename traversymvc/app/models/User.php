<?php

class User {
    private $db;
   public  function __construct()
    {
        $this->db = new Database;
    }
    // creat a regsiter function for user 
    public function register ($data)
    {
        $this->db->query('INSERT INTO users (name ,email, password) VALUES(:name, :email,:password)');
        //bind the name Value 
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        // call execute method 
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email,$password)
    {
        # this method to getthe data for user and password from databank
        $this->db->query('SELECT * FROM users WHERE email = :email ');
        $this->db->bind(':email',$email);

        $row = $this->db->single();

        $hashedPassword = $row->password;
        
        if (password_verify($password,$hashedPassword)) {
            # if the password matched return single method ...
            return $row;
        } else {
            return false;
        }
    }

    // Find Usser by Email

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email ');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row 
        if ($this->db->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id ');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

       return $row;
    }

}
?>