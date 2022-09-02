<?php
include_once '../../config/Database.php';
include_once '../../class/User.php';
include_once '../../class/Post.php';
include_once '../../class/Category.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);
$category = new Category($db);

//verifying if user is logged in
if (!$user->loggedIn()) {
    header('Location: ../index.php');
}

if (isset($_GET['id'])) {
    $post->id = $_GET['id'];
    $resultPost = $post->selectPost();
} else {
    header('Location: index.php?error=Ocorreu um erro ao tentar editar post!');
}

$errorMessage = '';
$categories = $category->listCategories();
$usersCount = $user->listUsersNumber();
$postsCount = $post->listPostsNumber();

$space = $database->freeSpace();

//creating post
if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['body']) && isset($_POST['imgDescription']) && isset($_POST['category']) && isset($_POST['status'])) {

    if (!empty($_POST['title']) && !empty($_POST['body']) && !empty($_POST['category']) && !empty($_POST['status'])) {

        if (!empty($_FILES["image"]["name"]) && !empty($_POST['imgDescription'])) {
            //getting file info
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            //allowing certain file type
            $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowTypes)) {
                $image = $_FILES["image"]["tmp_name"];
                $imgContent = addslashes(file_get_contents($image));

                $post->imgContent = $imgContent;
                $post->imgDescription = $_POST['imgDescription'];

                if ($post->imgInsert()) {
                    $post->title = $_POST['title'];
                    $post->body = $_POST['body'];
                    $post->category = $_POST['category'];
                    $post->status = $_POST['status'];
                    $post->author = $_SESSION['userid'];

                    if ($post->edit()) {
                        header('Location: index.php?success=Post editado com sucesso!');
                    } else {
                        $errorMessage = 'Não foi possível editar post!';
                    }
                } else {
                    $errorMessage = 'Não foi possível salvar imagem!';
                }
            }
        } else {
            if (mysqli_num_rows($resultPost)) {
                $row = mysqli_fetch_assoc($resultPost);

                $post->title = $_POST['title'];
                $post->body = $_POST['body'];
                $post->category = $_POST['category'];
                $post->status = $_POST['status'];
                $post->author = $_SESSION['userid'];
                $post->imgContent = $row['ds_image'];
                if ($post->edit()) {
                    header('Location: index.php?success=Post editado com sucesso!');
                } else {
                    $errorMessage = 'Não foi possível editar post!';
                }
            }
        }
    }
}
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Editar post</title>

    <!--Importing Bootstrap-->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!--Importing icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../../assets/images/mbr-1.png" type="image/x-icon">

    <!--Importing custom styles-->
    <link href="../../css/styles.css" rel="stylesheet" type="text/css">

    <!--Importing custom textarea-->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>


</head>

<body>

    <!--Navbar-->
    <?php include '../navbar.php'; ?>

    <!--Main message-->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><i class="bi bi-newspaper"></i> Posts </h1>
                </div>
                <!--col-md-10-->
            </div>
            <!--row-->
        </div>
        <!--container-->
    </header>
    <!--header-->

    <!--Breadcrumb-->
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="../home.php">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="index.php">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar post</li>
            </ol>
        </nav>
        <!--breadcrumb-->
    </div>
    <!--container-->

    <!--Main section-->
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!--List group showing areas you can manage-->
                    <div class="list-group">
                        <a href="../home.php" class="list-group-item list-group-item-action">
                            <i class="bi bi-house"></i> Home
                        </a>
                        <a href="../pages/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-file-earmark"></i> Páginas <span
                                class="badge text-bg-secondary">3</span></a>
                        <a href="index.php" class="list-group-item list-group-item-action active main-color-bg"><i
                                class="bi bi-newspaper"></i> Posts <span
                                class="badge text-bg-secondary"><?php echo $postsCount; ?></span></a>
                        <a href="../users/index.php" class="list-group-item list-group-item-action"
                            aria-current="true"><i class="bi bi-people-fill"></i> Usuários <span
                                class="badge text-bg-secondary"><?php echo $usersCount; ?></span></a>
                    </div>
                    <!--list-group-->
                    <br>
                    <!--Progress bar showing how full the database is-->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Espaço livre no banco <?php echo round($space, 2) ?>%</h4>
                            <div class="progress">
                                <?php if (round($space, 2) > 75) { ?>
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: <?php echo round($space, 2) ?>%;"
                                    aria-valuenow="<?php echo round($space, 2) ?>" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <?php echo round($space, 2) ?>%</div>
                                <?php } ?>

                                <?php if (round($space, 2) < 75 && round($space, 2) > 25) { ?>
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: <?php echo round($space, 2) ?>%;"
                                    aria-valuenow="<?php echo round($space, 2) ?>" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <?php echo round($space, 2) ?>%</div>
                                <?php } ?>

                                <?php if (round($space, 2) < 25) { ?>
                                <div class="progress-bar bg-danger" role="progressbar"
                                    style="width: <?php echo round($space, 2) ?>%;"
                                    aria-valuenow="<?php echo round($space, 2) ?>" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <?php echo round($space, 2) ?>%</div>
                                <?php } ?>
                            </div>
                            <!--progress-->
                        </div>
                    </div>
                    <!--card-->

                </div>
                <!--col-md-3-->
                <div class="col-md-9">
                    <h3>Editar post</h3>
                    <?php if ($errorMessage != '') { ?>
                    <div id="error-alert" class="alert alert-danger col-sm-12">
                        <i class="bi bi-exclamation-triangle"></i> <?php echo $errorMessage; ?>
                    </div>
                    <!--error-alert-->
                    <?php } ?>
                    <?php if (mysqli_num_rows($resultPost)) {
                        $row = mysqli_fetch_assoc($resultPost); ?>
                    <form action="#" method="post" id="createPost" role="form" class="card"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12 form-floating">
                                    <input type="text" name="title" id="title" placeholder="Informe o título"
                                        class="form-control" required value="<?php echo $row['ds_title'] ?>">
                                    <label for="name">Título</label>
                                </div>
                                <!--col-12-->
                                <div class="col-12 form-floating">
                                    <textarea id="editor" type="text" class="form-control" name="body"
                                        placeholder="Corpo da postagem">
                                        <?php echo $row['ds_body'] ?>
                                    </textarea>
                                    <label for="body"></label>
                                </div>
                                <!--col-12-->
                                <div class="col-12 input-group">
                                    <label for="image" class="input-group-text">Imagem</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <!--col-12-->

                                <div class="col-12">
                                    <p>Imagem atual</p>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['ds_image']); ?>"
                                        alt="<?php echo $row['ds_description'] ?>" class="img-fluid rounded"
                                        style='width: 336px; height: auto'>
                                </div>
                                <!--col-12-->

                                <div class="col-12 form-floating">
                                    <input type="text" name="imgDescription" id="imgDescription"
                                        placeholder="Informe a descrição da imagem" class="form-control"
                                        value="<?php echo $row['ds_description'] ?>">
                                    <label for="imgDescription">Descrição da imagem</label>
                                </div>
                                <!--col-12-->

                                <?php if (mysqli_num_rows($categories)) { ?>
                                <div class="col-md-6 form-floating">
                                    <select class="form-select" aria-label=".form-select-lg example"
                                        placeholder=" Escolha a categoria" id="category" name="category">
                                        <?php while ($rows = mysqli_fetch_assoc($categories)) {
                                                    if ($rows['id_category'] == $row['id_category']) { ?>
                                        <option selected value="<?php echo $rows['id_category'] ?>">
                                            <?php echo $rows['ds_name'] ?></option>

                                        <?php } else { ?>

                                        <option value="<?php echo $rows['id_category'] ?>">
                                            <?php echo $rows['ds_name'] ?></option>
                                        <?php }
                                                } ?>
                                    </select>
                                    <label>Categoria</label>
                                </div>
                                <!--col-md-6-->
                                <?php } ?>
                                <div class="col-md-4"><label>Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status"
                                            <?php if ($row['ds_status'] == 'publicado') { ?> checked <?php } ?>
                                            value="publicado">
                                        <label class="form-check-label" for="status">
                                            Publicado
                                        </label>
                                    </div>
                                    <!--form-check-->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status"
                                            <?php if ($row['ds_status'] == 'não publicado') { ?> checked <?php } ?>
                                            value="não publicado">
                                        <label class="form-check-label" for="status">
                                            Não publicado
                                        </label>
                                    </div>
                                    <!--form-check-->
                                </div>
                                <!--col-md-4-->
                                <div class="col-md-2"></div>
                                <!--col-md-2-->
                                <div class="col-12">
                                    <input type="submit" name='submit' value="Atualizar"
                                        class="btn btn-primary main-color-bg"> <a href="index.php"
                                        class="btn btn-outline-dark">Voltar</a>
                                </div>
                            </div>
                            <!--row g-3-->
                        </div>
                    </form>
                    <?php } ?>
                </div>
                <!--col-md-9-->
            </div>
            <!--row-->
        </div>
        <!--container-->
    </section>
    <!--main-->

    <!--Footer-->
    <footer id="footer" class="absolute-bottom footer py-3">
        <p id="copyright">Business Company &copy;
            <!--Script gets current year-->
            <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
        </p>
    </footer>

    <!--Importing scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/scripts.js"></script>

</body>

</html>