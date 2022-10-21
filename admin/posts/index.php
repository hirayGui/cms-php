<?php
include_once '../../config/Database.php';
include_once '../../class/User.php';
include_once '../../class/Post.php';
include_once '../../class/Category.php';
include_once '../../class/Client.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);
$category = new Category($db);
$client = new Client($db);

//verifying if user is logged in
if (!$user->loggedIn()) {
    header('Location: ../index.php');
}

$usersCount = $user->listUsersNumber();
$postsCount = $post->listPostsNumber();
$clientsCount = $client->listClientsNumber();
$categories = $category->listCategories();
$space = $database->freeSpace();

//pagination
$resultsPerPage = 5;

$pageNumber = ceil($postsCount / $resultsPerPage);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$pageFirstResult = ($page - 1) * $resultsPerPage;

$post->pageFirstResult = $pageFirstResult;
$post->resultsPerPage = $resultsPerPage;

$result = $post->listPosts();

//search field
if (isset($_POST['search'])) {
    $post->search = $_POST['search'];
    if (isset($_GET['category'])) {
        $post->category = $_GET['category'];
        $result = $post->listByCategory();
    } else {
        $result = $post->listPosts();
    }
}

//filtering by category
if (isset($_GET['category'])) {
    $post->category = $_GET['category'];
    $result = $post->listByCategory();
}
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Posts</title>

    <!--Importing Bootstrap-->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!--Importing icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../../assets/images/mbr-1.png" type="image/x-icon">

    <!--Importing custom styles-->
    <link href="../../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!--Navbar-->
    <?php include '../navbar.php'; ?>

    <!--Main section-->
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!--List group showing areas you can manage-->
                    <div id="menu">
                    <div class="list-group">
                        <a href="../home.php" class="list-group-item list-group-item-action">
                            <i class="bi bi-house-fill"></i> Home
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="collapse" data-bs-target="#site" data-bs-parent="#menu"><i class="bi bi-window-fullscreen"></i> Site</a>
                        <div class="sublinks collapse" id="site">
                            <a href="#" class="list-group-item small list-group-item-action"><i class="bi bi-file-person-fill"></i> Clientes <span class="badge text-bg-secondary"><?php echo $clientsCount ?></span></a>
                            <a href="#" class="list-group-item small list-group-item-action"><i class="bi bi-briefcase-fill"></i> Equipe</a>
                        </div>
                        <a href="index.php" class="list-group-item list-group-item-action active main-color-bg" aria-current="true"><i class="bi bi-newspaper"></i> Posts <span class="badge text-bg-secondary"><?php echo $postsCount; ?></span></a>
                        <a href="../users/index.php" class="list-group-item list-group-item-action"><i class="bi bi-people-fill"></i> Usuários <span class="badge text-bg-secondary"><?php echo $usersCount ?></span></a>
                    </div>
                    <!--list-group-->
                    </div>
                    <!--menu-->
                    <br>
                    <!--Progress bar showing how full the database is-->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Espaço livre no banco <?php echo round($space, 2) ?>%</h4>
                            <div class="progress">
                                <?php if (round($space, 2) > 75) { ?>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo round($space, 2) ?>%;" aria-valuenow="<?php echo round($space, 2) ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo round($space, 2) ?>%</div>
                                <?php } ?>

                                <?php if (round($space, 2) < 75 && round($space, 2) > 25) { ?>
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo round($space, 2) ?>%;" aria-valuenow="<?php echo round($space, 2) ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo round($space, 2) ?>%</div>
                                <?php } ?>

                                <?php if (round($space, 2) < 25) { ?>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo round($space, 2) ?>%;" aria-valuenow="<?php echo round($space, 2) ?>" aria-valuemin="0" aria-valuemax="100">
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
                    <?php if (isset($_GET['success'])) { ?>
                        <div id="success-alert" class="alert alert-success col-md-12">
                            <i class="bi bi-check-lg"></i> <?php echo $_GET['success']; ?>
                        </div>
                        <!--success-alert-->
                    <?php } ?>
                    <?php if (isset($_GET['error'])) { ?>
                        <div id="error-alert" class="alert alert-danger col-md-12">
                            <i class="bi bi-exclamation-triangle"></i> <?php echo $_GET['error']; ?>
                        </div>
                        <!--error-alert-->
                    <?php } ?>
                    <!--Main card-->
                    <div class="card">
                        <div class="card-header main-color-bg">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Visão Geral | Posts <i class="bi bi-newspaper"></i></h5>
                                </div>
                                <!--col-md-9-->
                                <div class="col-md-3">
                                    <a href="create.php" class="btn btn-success">
                                        <i class="bi bi-plus-lg"></i> Criar post
                                    </a>
                                    <!--btn btn-primary-->
                                </div>
                                <!--col-md-3-->
                            </div>
                            <!--row-->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" id="searchPost" role="form">
                                        <div class="row g-3">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" placeholder="Filtrar posts" id="search" name="search" value="<?php if (!empty($_POST['search']['value'])) {
                                                                                                                                                            echo $_POST['search'];
                                                                                                                                                        } ?>">
                                            </div>
                                            <!--col-md-11-->
                                            <div class="col-md-1">
                                                <button type="submit" class="btn main-color-bg" value="search" id="searchBtn"><i class="bi bi-search"></i></button>
                                            </div>
                                            <!--col-md-1-->
                                        </div>
                                        <!--row g-3-->
                                    </form>
                                </div>
                                <!--col-md-12-->
                            </div>
                            <!--row-->
                            <br>
                            <div class="table-responsive">
                                <?php if (mysqli_num_rows($result)) { ?>
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <th>Imagem</th>
                                            <th>Título</th>
                                            <th>Categoria</th>
                                            <th>Status</th>
                                            <th>Autor</th>
                                            <th>Data de Criação</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <?php
                                        while ($rows = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><a target="_blank" href='data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['ds_image']); ?>'><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['ds_image']); ?>" alt="<?php echo ucfirst($rows['ds_description']) ?>" class="img-thumbnail img-fluid rounded" style='width:100px'></a>
                                                </td>
                                                <td><?php echo mb_strimwidth(ucfirst($rows['ds_title']), 0, 25, '...') ?></td>
                                                <td><?php echo ucfirst($rows['category']) ?></td>
                                                <?php if ($rows['ds_status'] === "não publicado") { ?>
                                                    <td><button type="button" class="btn btn-danger"><?php echo ucfirst($rows['ds_status']); ?></button>
                                                    </td>
                                                <?php } else if ($rows['ds_status'] == 'publicado') { ?>
                                                    <td>
                                                        <p class="btn btn-success"><?php echo ucfirst($rows['ds_status']); ?>
                                                        </p>
                                                    </td>
                                                <?php } ?>
                                                <td><?php echo ucfirst($rows['author']) ?></td>
                                                <td><?php echo $rows['dt_created'] ?></td>
                                                <td><a name="update" id="<?php echo $rows['id_post'] ?>" href='edit.php?id=<?php echo $rows['id_post'] ?>' class="btn btn-outline-dark update"><i class="bi bi-pencil-fill"></i></a>
                                                </td>
                                                <td><a name="delete" id="<?php echo $rows['id_post'] ?>" class="btn btn-danger delete" href='delete.php?id=<?php echo $rows['id_post'] ?>'><i class="bi bi-trash3"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <!--table table-striped-->
                                <?php } ?>
                            </div>
                            <!--table-responsive-->
                            <br>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php if ($page == 1) { ?>disabled<?php } ?>">
                                        <a href="index.php?page=<?php echo $page - 1 ?>" class="page-link"><i class="bi bi-caret-left-fill"></i> Anterior</a>
                                        <!--page-link-->
                                    </li>
                                    <!--page-item-->
                                    <li class="page-item <?php if (($page * $resultsPerPage) >= $postsCount) { ?>disabled<?php } ?>">
                                        <a href="index.php?page=<?php echo $page + 1 ?>" class="page-link">Próximo <i class="bi bi-caret-right-fill"></i></a>
                                        <!--page-link-->
                                    </li>
                                    <!--page-item-->
                                </ul>
                                <!--pagination-justify-content-center-->
                            </nav>
                            <!--Page-navigation-->
                        </div>
                        <!--card-body-->
                    </div>
                    <!--card-->

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

</body>

</html>