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
  public function getUsername($id){
      $this->db->query("SELECT username from users where id = :id");
      $this->db->bind(':id', $id);

      //Assing Row
      $row = $this->db->single();
      return $row->username;
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

  public function getPasswordHashByEmail($email){
      $this->db->query("SELECT password FROM users WHERE email = :email");
      $this->db->bind(':email', $email);

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
  //Get user all details by emails
  public function getUserAllByEmail($email){
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(':email', $email);

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
  
  public function isAdmin($id) {
      $this->db->query("SELECT role from users where id = :id");

      //Bind Data
      $this->db->bind(':id', $id);
      
      $result = $this->db->single();

      if($result->role == "admin") {
        return true;
      }
      return false;
  }
  
    //Update Password of user
  public function updateUserPassword($data){
      //Insert Query
      $this->db->query("UPDATE users SET password = :password WHERE username = :username");

      //Bind Data
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':password', $data['password']);

      //Execute
      if($this->db->execute()){
        return true;
      }
        return false;
  }

  public function isSubscribed($id) {
      $this->db->query("SELECT subscriber from users where id = :id");

      //Bind Data
      $this->db->bind(':id', $id);
      
      $result = $this->db->single();

      if($result->subscriber == 1) {
        return true;
      }
      return false;
  }

  public function subscribe($id){
      //Insert Query
      $this->db->query("UPDATE users SET subscriber = 1 WHERE id = :id");

      //Bind Data
      $this->db->bind(':id', $id);

      //Execute
      if($this->db->execute()){
        return true;
      }
        return false;
  }

  public function getSubscribers() {
      $this->db->query("SELECT email from users where subscriber = 1");
      
      $results = $this->db->resultSet();
      return $results;
  }

}
