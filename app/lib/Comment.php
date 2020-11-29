<?php
class Comment{
    private $db;
  
    public function __construct(){
      $this->db = new Database;
    }

  // Get comments by a particular post_id
  public function getCommentsByPost($post_id){
    $this->db->query("SELECT comments.id, comments.message, users.username, comments.created_at
                FROM comments
                INNER JOIN users
                ON comments.user_id = users.id
                WHERE post_id = :post_id
                ORDER BY created_at ASC
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

  public function createComment($user_id,$post_id,$message){
    $this->db->query("INSERT INTO comments (post_id, user_id, message)
    VALUES(:post_id, :user_id, :message)");

    $this->db->bind(':post_id', $post_id);
    $this->db->bind(':user_id', $user_id);
    $this->db->bind(':message', $message);

    if($this->db->execute()){
      return true;
    }
    return false;
  }

  public function deleteComment($id){
    $this->db->query("DELETE FROM comments WHERE id = :id");

    $this->db->bind(':id', $id);

    if($this->db->execute()){
      return true;
    }
    return false;
  }
  

}

?>