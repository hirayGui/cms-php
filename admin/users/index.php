<?php
include_once '../../config/Database.php';
include_once '../../class/User.php';
include_once '../../class/Post.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);

//verifying if user is logged in
if (!$user->loggedIn()) {
    header('Location: ../index.php');
}

$usersCount = $user->listUsersNumber();
$postsCount = $post->listPostsNumber();
$space = $database->freeSpace();

//pagination
$resultsPerPage = 5;

$pageNumber = ceil($usersCount / $resultsPerPage);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$pageFirstResult = ($page - 1) * $resultsPerPage;

$user->pageFirstResult = $pageFirstResult;
$user->resultsPerPage = $resultsPerPage;

$result = $user->listUsers();

//search field
if (isset($_POST['search'])) {
    $user->search = $_POST['search'];
    $result = $user->listUsers();
} else {
    $result = $user->listUsers();
}

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Usuários</title>

    <!--Importing Bootstrap-->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                    <div class="list-group">
                        <a href="../home.php" class="list-group-item list-group-item-action">
                            <i class="bi bi-house-fill"></i> Home
                        </a>
                        <a href="../pages/index.php" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-fill"></i> Páginas <span class="badge text-bg-secondary">3</span></a>
                        <a href="../posts/index.php" class="list-group-item list-group-item-action"><i class="bi bi-newspaper"></i> Posts <span class="badge text-bg-secondary"><?php echo $postsCount; ?></span></a>
                        <a href="index.php" class="list-group-item list-group-item-action active main-color-bg" aria-current="true"><i class="bi bi-people-fill"></i> Usuários <span class="badge text-bg-secondary"><?php echo $usersCount; ?></span></a>
                    </div>
                    <!--list-group-->
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
                                    <h5>Visão Geral | Usuários <i class="bi bi-people-fill"></i></h5>
                                </div>
                                <!--col-md-8-->
                                <div class="col-md-3">
                                    <?php if ($user->isAdmin()) {
                                    ?>
                                        <a href="create.php" class="btn btn-success">
                                            <i class="bi bi-plus-lg"></i> Criar usuário
                                        </a>
                                        <!--btn btn-primary-->
                                    <?php } ?>
                                </div>
                                <!--col-md-4-->
                            </div>
                            <!--row-->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" id="searchUser" role="form">
                                        <div class="row g-3">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" placeholder="Filtrar usuários" id="search" name="search" value="<?php if (!empty($_POST['search']['value'])) {
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
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Tipo</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($rows = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo ucfirst($rows['ds_name']) ?></td>
                                                    <td><?php echo $rows['ds_email'] ?></td>
                                                    <td><?php echo ucfirst($rows['ds_role']) ?></td>
                                                    <?php if ($rows['ds_status'] == "inativo") { ?>
                                                        <td><button type="button" class="btn btn-danger"><?php echo ucfirst($rows['ds_status']); ?></button>
                                                        </td>
                                                    <?php } else if ($rows['ds_status'] == 'ativo') { ?>
                                                        <td>
                                                            <p class="btn btn-success"><?php echo ucfirst($rows['ds_status']); ?>
                                                            </p>
                                                        </td>
                                                    <?php } ?>
                                                    <td><a name="update" id="<?php echo $rows['id_user'] ?>" href='edit.php?id=<?php echo $rows['id_user'] ?>' class="btn btn-outline-dark update"><i class="bi bi-pencil-fill"></i></a>
                                                    </td>
                                                    <td><a name="delete" id="<?php echo $rows['id_user'] ?>" class="btn btn-danger delete" href='delete.php?id=<?php echo $rows['id_user'] ?>'><i class="bi bi-trash3"></i></a></td>
                                                </tr>
                                            <?php
                                            } ?>
                                            <!--while-->
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <!--table table-striped-->
                            </div>
                            <!--table-responsive-->
                            <br>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php if ($page == 1) { ?> disabled <?php } ?>">
                                        <a href="index.php?page=<?php echo $page - 1 ?>" class="page-link"><i class="bi bi-caret-left-fill"></i> Anterior</a>
                                        <!--page-link-->
                                    </li>
                                    <!--page-item-->
                                    <li class="page-item <?php if (($page * $resultsPerPage) >= $usersCount) { ?> disabled <?php } ?>">
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
    <footer id="footer" class="footer py-3 fixed-bottom">
        <p id="copyright">Business Company &copy;
            <!--Script gets current year-->
            <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
        </p>
    </footer>

    <!--Importing scripts-->
    <script>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="../../js/bootstrap.min.js"></script>

</body>

</html>