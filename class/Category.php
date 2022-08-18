<?php

class Category
{
    private $categoryTable = 'tb_categories';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listCategories()
    {
        $sqlQuery = 'SELECT id_category, ds_name FROM ' . $this->categoryTable . ' ';
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}