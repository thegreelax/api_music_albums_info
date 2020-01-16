<?php
class Album
{
    private $connection;
    private $table_name = "album";
 
    public $id;
    public $title;
    public $cover;
    public $musician;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
     
        $query = "SELECT * FROM ".$this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
     
        return $stmt;
    }
}
?>