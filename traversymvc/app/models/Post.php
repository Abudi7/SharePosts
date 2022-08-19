<?php
//pposts Modell display 
class Post
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts()
    {
        # this Method to get The content fromn the Post table in database 
        $this->db->query('SELECT * ,
                          posts.id AS postId , 
                          users.id AS userId ,
                          posts.created_at AS postCreated ,
                          users.created_at AS userCreated
                          FROM posts 
                          INNER JOIN users 
                          ON posts.users_id = users.id 
                          ORDER BY posts.created_at DESC');

        $result = $this->db->resultset();
        return $result;
    }
public function addPost($data)
{
    # code...
    $this->db->query('INSERT INTO posts (title ,users_id,body) VALUES(:title,:user_id , :body)');
    //bind the name Value 
    $this->db->bind(':title',$data['title']);
    $this->db->bind(':body',$data['body']);
    $this->db->bind(':user_id',$data['user_id']);

    // call execute method 
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function updatePost($data)
{
    # code...
    $this->db->query('UPDATE posts SET title = :title , body = :body WHERE id = :id');
    //bind the name Value 
    $this->db->bind(':id',$data['id']);
    $this->db->bind(':title',$data['title']);
    $this->db->bind(':body',$data['body']);
  

    // call execute method 
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function deletePost($id)
{
    # query for the delete record from the database...
    $this->db->query('DELETE FROM posts WHERE id = :id');
    $this->db->bind(':id',$id);
     // call execute method 
     if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function getPostsById($id)
{
    # this method to show me just one record from database with right id 
    $this->db->query('SELECT * FROM posts WHERE id = :id');
    $this->db->bind(':id',$id);

    $row = $this->db->single();

    return $row;
}

}
?>