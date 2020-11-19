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

  // Get posts by creator's user_id
  public function getPostsByUser($user_id){
    $this->db->query("SELECT *
                FROM posts
                WHERE user_id = :user_id
                ORDER BY created_at DESC
                ");
    $this->db->bind(':user_id',$user_id);
    
    $results = $this->db->resultSet();
    return $results;
  }


  public function checkIfApplied($userid,$postid)
  {
    $this->db->query("SELECT * FROM appliedjobs WHERE user_id=:userid AND post_id=:postid");
    $this->db->bind(':userid',$userid);
    $this->db->bind(':postid', $postid);
    $results = $this->db->resultSet();
    return $results;
  }

  public function applyForPost($user_id,$post_id)
  {
      $this->db->query("INSERT INTO appliedjobs (user_id, post_id, status) 
      VALUES(:userid, :postid,'Applied')");
      $this->db->bind(':userid', $user_id);
      $this->db->bind(':postid', $post_id);
      if($this->db->execute()){
          return true;
      }
      return false;
  }      

  // Search for posts having similar creator's username
  public function searchPosts($search){
      
      $datesearch = $search;
      preg_match('/(\d)*\/(\d)*/', $datesearch, $matches);
      if($matches) {
        $datesearch = explode("/",$datesearch);
        $datesearch = $datesearch[1]."-".$datesearch[0];
      }

      $search = '%'.$search.'%';
      $datesearch = '%'.$datesearch.'%';

      $this->db->query("SELECT posts.*, users.username
                  FROM posts
                  INNER JOIN users
                  ON posts.user_id = users.id
                  WHERE users.username LIKE :search OR posts.created_at LIKE :datesearch OR posts.title LIKE :search
                  ORDER BY created_at DESC
                  ");
      $this->db->bind(':search',$search);
      $this->db->bind(':datesearch',$datesearch);
      
      $results = $this->db->resultSet();
      return $results;
  }

  //Get post by id
  public function getPost($id){
      $this->db->query("SELECT posts.*,users.username as creator
      FROM posts INNER JOIN users
      ON posts.user_id = users.id
      WHERE posts.id = :id");
      $this->db->bind(':id', $id);

      //Assing Row
      $row = $this->db->single();

      return $row;
  }

  //Create post
  public function createPost($data){
      //Insert Query
      $this->db->query("INSERT INTO posts (user_id, title, description, contact)
      VALUES(:user_id, :title, :description, :contact)");

      //Bind Data
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':contact', $data['contact']);

      //Execute
      if($this->db->execute()){
        return true;
      }
      return false;
  }

  //Delete post
  public function deletePost($id){
    //Insert Query
    $this->db->query("DELETE FROM posts WHERE id = $id");

    //Execute
    if($this->db->execute()){
      return true;
    }
      return false;
  }

  //Update posts
  public function updatePost($id, $data){
      $this->db->query("UPDATE posts
            SET
            user_id = :user_id,
            title = :title,
            description = :description,
            contact = :contact,
            approved = 0
            WHERE id= $id");

      //Bind Data
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':contact', $data['contact']);

      //Execute
      if($this->db->execute()){
        return true;
      }
        return false;
  }

}
