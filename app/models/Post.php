<?php
// example post model for creating a model
class Post {

    private $db;

    public function __construct() {
        //  connecting to database
        $this->db = new Db;
    }
    // getting all posts from the db using the query method
    // from the db.php
    public function getPosts() {
        $this->db->query("SELECT * FROM posts");
        return $this->db->setResult();
    }
}