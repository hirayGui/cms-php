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

$result = $post->listPosts();
$usersCount = $user->listUsersNumber();
$postsCount = $post->listPostsNumber();
$space = $database->freeSpace();
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

    <!--Main message-->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h1><i class="bi bi-newspaper"></i> Posts </h1>
                </div>
                <!--col-md-10-->
                <div class="col-md-3">
                    <div class="create">
                        <!-- Button trigger modal -->
                        <a class="btn btn-primary main-color-bg" href="create.php">
                            <i class="bi bi-plus-lg"></i> Criar novo post
                        </a>
                        <!--btn btn-primary-->
                    </div>
                    <!--create-->
                </div>
                <!--col-md-2-->
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
                <li class="breadcrumb-item active" aria-current="page">Posts</li>
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
                        <a href="index.php" class="list-group-item list-group-item-action active main-color-bg"
                            aria-current="true"><i class="bi bi-newspaper"></i> Posts <span
                                class="badge text-bg-secondary"><?php echo $postsCount; ?></span></a>
                        <a href="../users/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-people-fill"></i> Usuários <span
                                class="badge text-bg-secondary"><?php echo $usersCount ?></span></a>
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
                    <?php if (isset($_GET['success'])) { ?>
                    <div id="success-alert" class="alert alert-success col-md-12">
                        <?php echo $_GET['success']; ?>
                    </div>
                    <!--success-alert-->
                    <?php } ?>
                    <?php if (isset($_GET['error'])) { ?>
                    <div id="error-alert" class="alert alert-danger col-md-12">
                        <?php echo $_GET['error']; ?>
                    </div>
                    <!--error-alert-->
                    <?php } ?>
                    <!--Cards showing simplified statistics-->
                    <div class="card">
                        <div class="card-header main-color-bg">
                            <h5>Visão Geral | Publicações</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Filtrar posts">
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
                                        <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['ds_image']); ?>"
                                                alt="<?php echo ucfirst($rows['ds_description']) ?>"
                                                class="img-thumbnail"></td>
                                        <td><?php echo ucfirst($rows['ds_title']) ?></td>
                                        <td><?php echo ucfirst($rows['category']) ?></td>
                                        <?php if ($rows['ds_status'] === "não publicado") { ?>
                                        <td><button type="button"
                                                class="btn btn-danger"><?php echo ucfirst($rows['ds_status']); ?></button>
                                        </td>
                                        <?php } else if ($rows['ds_status'] == 'publicado') { ?>
                                        <td>
                                            <p class="btn btn-success"><?php echo ucfirst($rows['ds_status']); ?>
                                            </p>
                                        </td>
                                        <?php } ?>
                                        <td><?php echo ucfirst($rows['author']) ?></td>
                                        <td><?php echo $rows['dt_created'] ?></td>
                                        <td><a name="update" id="<?php echo $rows['id_post'] ?>"
                                                href='edit.php?id=<?php echo $rows['id_post'] ?>'
                                                class="btn btn-outline-dark update"><i
                                                    class="bi bi-pencil-fill"></i></a>
                                        </td>
                                        <td><a name="delete" id="<?php echo $rows['id_post'] ?>"
                                                class="btn btn-danger delete"
                                                href='delete.php?id=<?php echo $rows['id_post'] ?>'><i
                                                    class="bi bi-trash3"></i></a></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                <!--table table-striped-->
                                <?php } ?>
                            </div>
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
    <footer id="footer" class="absolute-bottom">
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