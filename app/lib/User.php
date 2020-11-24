<?php
class User{
  private $db;

  public function __construct(){
    $this->db = new Database;
  }

  //Get all Users
  public function getUsers(){
    $this->db->query("");
    $results = $this->db->resultSet();
    return $results;
  }

  //Get user by id
  public function getUser($id){
      $this->db->query("");
      $this->db->bind(':id', $id);

      //Assing Row
      $row = $this->db->single();
      return $row;
  }

  public function getUserByEmail($email){
      $this->db->query("SELECT id FROM users WHERE email = :email");
      $this->db->bind(':email', $email);

      //Assing Row
      $results = $this->db->resultSet();
      return $results;
  }

  public function getUserByUsername($username){
      $this->db->query("SELECT id FROM users WHERE username = :username");
      $this->db->bind(':username', $username);

      //Assing Row
      $result = $this->db->single();
      return $result;
  }

  public function getPasswordHashByUsername($username){
      $this->db->query("SELECT password FROM users WHERE username = :username");
      $this->db->bind(':username', $username);

      //Assing Row
      $row = $this->db->single();
      return $row;
  }
  //Get user all details by username
  public function getUserAllByUsername($username){
    $this->db->query("SELECT * FROM users WHERE username = :username");
    $this->db->bind(':username', $username);

    //Assing Row
    $result = $this->db->single();
    return $result;
}
  //Create user
  public function createUser($data){
      //Insert Query
      $this->db->query("INSERT INTO users (email, username, password) VALUES(:email, :username, :password)");

      //Bind Data
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':password', $data['password']);

      //Execute
      if($this->db->execute()){
        return true;
      }
        return false;
  }
}
