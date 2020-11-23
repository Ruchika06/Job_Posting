<?php
class Comment{
    private $db;
  
    public function __construct(){
      $this->db = new Database;
    }

  // Get comments by a particular post_id
  public function getCommentsByPost($post_id){
    $this->db->query("SELECT *
                FROM comments
                WHERE post_id = :post_id
                ORDER BY created_at DESC
                ");
    $this->db->bind(':post_id',$post_id);
    
    $results = $this->db->resultSet();
    return $results;
  }

  // Get comments by a particular user_id
  public function getCommentsByUser($user_id){
    $this->db->query("SELECT *
                FROM comments
                WHERE user_id = :user_id
                ORDER BY created_at DESC
                ");
    $this->db->bind(':user_id',$user_id);
        
    $results = $this->db->resultSet();
    return $results;
}


?>