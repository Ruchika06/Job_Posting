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

  //Get post by id
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

//   //Delete posts
//   public function delete($id){
//     //Insert Query
//     $this->db->query("DELETE FROM posts WHERE id = $id");

//     //Execute
//     if($this->db->execute()){
//       return true;
//     }
//       return false;
// }

// //Create posts
// public function update($id, $data){
//     //Insert Query
//     $this->db->query("UPDATE posts
//           SET
//           category_id = :category_id,
//           posts_title = :posts_title,
//           company = :company,
//           description = :description,
//           location = :location,
//           salary = :salary,
//           contact_user = :contact_user,
//           contact_email = :contact_email
//           WHERE id= $id");

//     //Bind Data
//     $this->db->bind(':category_id', $data['category_id']);
//     $this->db->bind(':posts_title', $data['posts_title']);
//     $this->db->bind(':company', $data['company']);
//     $this->db->bind(':description', $data['description']);
//     $this->db->bind(':location', $data['location']);
//     $this->db->bind(':salary', $data['salary']);
//     $this->db->bind(':contact_user', $data['contact_user']);
//     $this->db->bind(':contact_email', $data['contact_email']);

//     //Execute
//     if($this->db->execute()){
//       return true;
//     }
//       return false;
// }

}
