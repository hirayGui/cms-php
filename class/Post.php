<?php

class Post
{
    private $postTable = 'tb_posts';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listPosts()
    {
        $sqlQuery = 'SELECT p.id_post, p.ds_title, p.ds_body,DATE_FORMAT(p.dt_created, "%e %b %Y") as dt_created, p.ds_status, c.ds_name as category, u.ds_name as author, i.ds_image, i.ds_description FROM tb_posts p INNER JOIN tb_categories c ON c.id_category = p.id_category INNER JOIN tb_users u ON u.id_user = p.id_user INNER JOIN tb_images i ON i.id_image = p.id_image';

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function listPostsNumber()
    {
        $sqlQuery = 'SELECT id_post, ds_title, ds_body, DATE_FORMAT(dt_created, "%e %b %Y") as dt_created, ds_status, id_user, id_category, id_image FROM ' . $this->postTable;

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result)) {
            $postsCount = mysqli_num_rows($result);
        } else {
            $postsCount = 0;
        }
        return $postsCount;
    }

    public function insert()
    {
        if ($_SESSION['role'] && $_SESSION['userid']) {
            $imgQuery = 'SELECT id_image FROM tb_images WHERE ds_image = "' . $this->imgContent . '"';
            $stmt = $this->conn->prepare($imgQuery);
            $stmt->execute();
            $result = $stmt->get_result();

            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                $imageId = $row['id_image'];

                if ($imageId > 0) {
                    $stmt = $this->conn->prepare('INSERT INTO ' . $this->postTable . ' (ds_title, ds_body, ds_status, id_user, id_category, id_image) VALUES (?, ?, ?, ?, ?, ?)');
                    $this->title = htmlspecialchars(strip_tags($this->title));
                    $this->body = htmlspecialchars(strip_tags($this->body));
                    $this->status = htmlspecialchars(strip_tags($this->status));
                    $stmt->bind_param('sssiii', $this->title, $this->body, $this->status, $this->author, $this->category, $imageId);

                    if ($stmt->execute()) {
                        return true;
                    }
                }
            }
        }
    }

    public function imgInsert()
    {
        if ($_SESSION['role'] && $_SESSION['userid']) {
            $testQuery = 'SELECT id_image FROM tb_images WHERE ds_image = "' . $this->imgContent . '"';
            $stmt = $this->conn->prepare($testQuery);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                $stmt = $this->conn->prepare("INSERT INTO tb_images (ds_image, ds_description) VALUES ('$this->imgContent', '$this->imgDescription'); ");

                if ($stmt->execute()) {
                    return true;
                }
            } else {
                return true;
            }
        }
    }
}