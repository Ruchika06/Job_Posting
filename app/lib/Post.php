<?php
class Post{
  private $db;

  public function __construct(){
    $this->db = new Database;
  }

  //Get all posts
  public function getPosts(){
    $this->db->query("SELECT posts.*, users.username
                FROM posts
                INNER JOIN users
                ON posts.user_id = users.id
                ORDER BY created_at DESC
                ");
    
    $results = $this->db->resultSet();
    return $results;
  }

  public function getappliedPosts($userid){
    $this->db->query("SELECT title, description,status,applied_at FROM appliedjobs INNER JOIN posts ON appliedjobs.post_id=posts.id WHERE appliedjobs.user_id=:userid");
    $this->db->bind(':userid',$userid);
    $results = $this->db->resultSet();
    return $results;
  }
  public function checkpost($userid,$postid)
  {
        $this->db->query("SELECT * FROM appliedjobs INNER JOIN posts WHERE appliedjobs.user_id=:userid AND appliedjobs.post_id=:postid" );
    $this->db->bind(':userid',$userid);
    $this->db->bind(':postid', $postid);
    $results = $this->db->resultSet();
    return $results;
  }
  public function applypost($user_id,$post_id)
  {
  $this->db->query("INSERT INTO appliedjobs (user_id, post_id, status)
      VALUES(:userid, :postid,'Reviewing')");
  $this->db->bind(':userid', $user_id);
  $this->db->bind(':postid', $post_id);
  if($this->db->execute()){
        return true;
      }
        return false;
  }      




  // Get posts By creator's username
  public function getByCreator($creator_username){
    $this->db->query("SELECT posts.*, users.username
                FROM posts
                INNER JOIN users
                ON posts.user_id = users.id
                WHERE users.username LIKE '%:creator_username%'
                ORDER BY created_at DESC
                ");
    $this->db->bind(':creator_username',$creator_username);
    
    $results = $this->db->resultSet();
    return $results;
  }

  //Get post by id
  public function getPost($id){
      $this->db->query("SELECT * FROM posts WHERE id = :id");
      $this->db->bind(':id', $id);

      //Assing Row
      $row = $this->db->single();

      return $row;
  }

  //Create posts
  public function create($data){
      //Insert Query
      $this->db->query("INSERT INTO posts (category_id, posts_title, company, description, location, salary, contact_user,
                      contact_email)
      VALUES(:category_id, :posts_title, :company, :description, :location, :salary, :contact_user, :contact_email)");

      //Bind Data
      $this->db->bind(':category_id', $data['category_id']);
      $this->db->bind(':posts_title', $data['posts_title']);
      $this->db->bind(':company', $data['company']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':location', $data['location']);
      $this->db->bind(':salary', $data['salary']);
      $this->db->bind(':contact_user', $data['contact_user']);
      $this->db->bind(':contact_email', $data['contact_email']);

      //Execute
      if($this->db->execute()){
        return true;
      }
        return false;
  }

  //Delete posts
  public function delete($id){
    //Insert Query
    $this->db->query("DELETE FROM posts WHERE id = $id");

    //Execute
    if($this->db->execute()){
      return true;
    }
      return false;
}

//Create posts
public function update($id, $data){
    //Insert Query
    $this->db->query("UPDATE posts
          SET
          category_id = :category_id,
          posts_title = :posts_title,
          company = :company,
          description = :description,
          location = :location,
          salary = :salary,
          contact_user = :contact_user,
          contact_email = :contact_email
          WHERE id= $id");

    //Bind Data
    $this->db->bind(':category_id', $data['category_id']);
    $this->db->bind(':posts_title', $data['posts_title']);
    $this->db->bind(':company', $data['company']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':location', $data['location']);
    $this->db->bind(':salary', $data['salary']);
    $this->db->bind(':contact_user', $data['contact_user']);
    $this->db->bind(':contact_email', $data['contact_email']);

    //Execute
    if($this->db->execute()){
      return true;
    }
      return false;
}

}
