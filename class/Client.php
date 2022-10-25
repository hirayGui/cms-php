<?php 

class Client{
    private $clientTable = 'tb_clients';
    private $imageTable = 'tb_images';
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function listClients(){
        $sqlQuery = 'SELECT c.id_client, c.ds_name, i.ds_image, i.ds_description FROM ' . $this->clientTable . ' c INNER JOIN tb_images i ON c.id_image = i.id_image ORDER BY c.id_client DESC';

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function selectClient(){
        if($this->id){
            $sqlQuery = 'SELECT c.id_client, c.ds_name, i.id_image, i.ds_image, i.ds_description FROM '. $this->clientTable .' c INNER JOIN '. $this->imageTable .' i ON c.id_image = i.id_image WHERE c.id_client = ?';

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;

        }
    }

    public function listClientsNumber(){
        $sqlQuery = 'SELECT id_client FROM '. $this->clientTable;

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result)){
            $clientsCount = mysqli_num_rows($result);
        } else {
            $clientsCount = 0;
        }

        return $clientsCount;

    }

    public function insert(){
        if($_SESSION['role'] && $_SESSION['userid']){
            $imgQuery = 'SELECT id_image FROM '. $this->imageTable .' WHERE ds_image = "'. $this->imgContent .'"';
            $stmt = $this->conn->prepare($imgQuery);
            $stmt->execute();
            $result = $stmt->get_result();

            if(mysqli_num_rows($result)){
                $row = mysqli_fetch_assoc($result);
                $imageId = $row['id_image'];

                if($imageId > 0){
                    $stmt = $this->conn->prepare('INSERT INTO '. $this->clientTable . '(ds_name, id_image) VALUES (?, ?)');
                    $this->name = htmlspecialchars(strip_tags($this->name));
                    $stmt->bind_param('si', $this->name, $imageId);

                    if($stmt->execute()){
                        return true;
                    }
                }
            }
        }
    }

    public function imgInsert(){
        if($_SESSION['role'] && $_SESSION['userid']){
            $testQuery = 'SELECT id_image FROM '. $this->imageTable .' WHERE ds_image = "'. $this->imgContent .'"';
            $stmt = $this->conn->prepare($testQuery);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows == 0){
                $stmt = $this->conn->prepare('INSERT INTO '. $this->imageTable .' (ds_image, ds_description) VALUES ("'. $this->imgContent .'", "'. $this->imgDescription .'"); ');

                if($stmt->execute()){
                    return true;
                }

            } else {
                return true;
            }

        }
    }

    public function edit(){
        if($_SESSION['role'] && $_SESSION['userid']){
            $imgQuery = 'SELECT id_image FROM '. $this->imageTable .' WHERE ds_image = "'. $this->imgContent .'"';
            $stmt = $this->conn->prepare($imgQuery);
            $stmt->execute();
            $result = $stmt->get_result();

            if(mysqli_num_rows($result)){
                $row = mysqli_fetch_assoc($result);
                $imageId = $row['id_image'];

                if($imageId > 0){
                    $stmt = $this->conn->prepare('UPDATE '. $this->clientTable .' SET ds_name = ?, id_image = ? WHERE id_client = ?');
                    $this->name = htmlspecialchars(strip_tags($this->name));
                    $stmt->bind_param('sii', $this->name, $imageId, $this->id);

                    if($stmt->execute()){
                        return true;
                    }
                }
            }
        }
    }

    public function delete(){
        if($this->id){
            if($_SESSION['role']){
                $stmt = $this->conn->prepare('DELETE FROM '. $this->clientTable .' WHERE id_client = ?');
                $this->id = $this->id;
                $stmt->bind_param('i', $this->id);

                if($stmt->execute()){
                    $stmt = $this->conn->prepare('DELETE FROM '. $this->imageTable .' WHERE id_image = ?');
                    $stmt->bind_param('i', $this->imageId);

                    if($stmt->execute()){
                        return true;
                    }
                }
            }
        }
    }

}


?>