<?php

class Post
{
    private $postTable = 'tb_posts';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function selectPost()
    {
        if ($this->id) {
            $sqlQuery = 'SELECT p.ds_title, p.ds_body, p.ds_status, p.id_user, p.id_category, p.id_image, i.ds_image, i.ds_description FROM ' . $this->postTable . ' p INNER JOIN tb_images i ON i.id_image = p.id_image WHERE p.id_post = ?;';

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
        }
    }

    public function listPosts()
    {
        $sqlQuery = 'SELECT p.id_post, p.ds_title, p.ds_body,DATE_FORMAT(p.dt_created, "%e %b %Y às %H:%i") as dt_created, p.ds_status, c.ds_name as category, u.ds_name as author, i.ds_image, i.ds_description FROM tb_posts p INNER JOIN tb_categories c ON c.id_category = p.id_category INNER JOIN tb_users u ON u.id_user = p.id_user INNER JOIN tb_images i ON i.id_image = p.id_image ORDER BY p.dt_created DESC';

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function listPublishedPosts()
    {
        $sqlQuery = 'SELECT p.id_post, p.ds_title, p.ds_body,DATE_FORMAT(p.dt_created, "%e %b %Y às %H:%i") as dt_created, p.ds_status, c.ds_name as category, u.ds_name as author, i.ds_image, i.ds_description FROM tb_posts p INNER JOIN tb_categories c ON c.id_category = p.id_category INNER JOIN tb_users u ON u.id_user = p.id_user INNER JOIN tb_images i ON i.id_image = p.id_image WHERE p.ds_status = "publicado" ORDER BY p.dt_created DESC';

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function listLastPublishedPosts()
    {
        $sqlQuery = 'SELECT p.id_post, p.ds_title, p.ds_body,DATE_FORMAT(p.dt_created, "%e %b %Y às %H:%i") as dt_created, p.ds_status, c.ds_name as category, u.ds_name as author, i.ds_image, i.ds_description FROM tb_posts p INNER JOIN tb_categories c ON c.id_category = p.id_category INNER JOIN tb_users u ON u.id_user = p.id_user INNER JOIN tb_images i ON i.id_image = p.id_image WHERE p.ds_status = "publicado" ORDER BY p.dt_created DESC LIMIT 3';

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function listPostsNumber()
    {
        $sqlQuery = 'SELECT id_post FROM ' . $this->postTable;

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

    public function edit()
    {
        if ($_SESSION['role'] && $_SESSION['userid']) {
            $imgQuery = 'SELECT id_image FROM tb_images WHERE ds_image = "' . addslashes($this->imgContent) . '"';
            $stmt = $this->conn->prepare($imgQuery);
            $stmt->execute();
            $result = $stmt->get_result();

            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                $imageId = $row['id_image'];

                if ($imageId > 0) {
                    $stmt = $this->conn->prepare('UPDATE ' . $this->postTable . ' SET ds_title = ?, ds_body = ?, ds_status = ?, id_user = ?, id_category = ?, id_image = ? WHERE id_post = ?');
                    $this->title = htmlspecialchars(strip_tags($this->title));
                    $this->body = htmlspecialchars(strip_tags($this->body));
                    $this->status = htmlspecialchars(strip_tags($this->status));
                    $stmt->bind_param('sssiiii', $this->title, $this->body, $this->status, $this->author, $this->category, $imageId, $this->id);

                    if ($stmt->execute()) {
                        return true;
                    }
                }
            }
        }
    }

    public function delete()
    {
        if ($this->id) {
            if ($_SESSION['role'] == "admin") {
                $stmt = $this->conn->prepare("
            DELETE FROM " . $this->postTable . " WHERE id_post = ?");
                $this->id = $this->id;
                $stmt->bind_param('i', $this->id);

                if ($stmt->execute()) {
                    $stmt = $this->conn->prepare("DELETE FROM tb_images WHERE id_image = ?");
                    $stmt->bind_param('i', $this->imageId);

                    if ($stmt->execute()) {
                        return true;
                    }
                }
            }
        }
    }
}