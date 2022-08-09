<?php
include_once '../config/Database.php';
include_once '../class/User.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//verifying if user is logged in
if (!$user->loggedIn()) {
    header('Location: index.php');
}

if (!$user->isActive()) {
    header('Location: logout.php');
}

$usersCount = $user->listUsersNumber();
$space = $database->freeSpace();
$lastUsers = $user->listLastUsers();
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Home</title>

    <!--Importing Bootstrap-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!--Importing icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/images/mbr-1.png" type="image/x-icon">

    <!--Importing custom styles-->
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- Navbar-->
    <nav class="navbar navbar-expand-md navbar-default sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Painel de Controle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--navbar-toggler-->

            <!--Navbar items-->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/index.php">Páginas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="posts/index.php">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users/index.php">Usuários</a>
                    </li>
                </ul>
                <ul class="navbar-right navbar-nav nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
            <!--collapse navbar-nav-->
        </div>
        <!--container-fluid-->
    </nav>
    <!--navbar navbar-expand-md -->

    <!--Main message-->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><i class="bi bi-house"> </i>Home - <small>Gerencie seu site</small></h1>
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
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Home</a></li>
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
                        <a href="home.php" class="list-group-item list-group-item-action active main-color-bg"
                            aria-current="true">
                            <i class="bi bi-house"></i> Home
                        </a>
                        <a href="pages/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-file-earmark"></i> Páginas <span
                                class="badge text-bg-secondary">3</span></a>
                        <a href="posts/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-newspaper"></i> Posts <span class="badge text-bg-secondary">5</span></a>
                        <a href="users/index.php" class="list-group-item list-group-item-action"><i
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
                    <!--Cards showing simplified statistics-->
                    <div class="card">
                        <div class="card-header main-color-bg">
                            <h5>Visão Geral</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-md-3">
                                    <div class="card dash-box">
                                        <div class="card-body">
                                            <h2><i class="bi bi-people-fill"></i> <?php echo $usersCount ?> </h2>
                                            <h4>Usuários</h4>
                                        </div>
                                    </div>
                                    <!--card dash-box-->
                                </div>
                                <!--col-md-3-->
                                <div class="col-3 col-md-3">
                                    <div class="card dash-box">
                                        <div class="card-body">
                                            <h2><i class="bi bi-file-earmark"></i> 3 </h2>
                                            <h4>Páginas</h4>
                                        </div>
                                    </div>
                                    <!--card dash-box-->
                                </div>
                                <!--col-md-3-->
                                <div class="col-3 col-md-3">
                                    <div class="card dash-box">
                                        <div class="card-body">
                                            <h2><i class="bi bi-newspaper"></i> 5 </h2>
                                            <h4>Posts</h4>
                                        </div>
                                    </div>
                                    <!--card dash-box-->
                                </div>
                                <!--col-md-3-->
                                <div class="col-3 col-md-3">
                                    <div class="card dash-box">
                                        <div class="card-body">
                                            <h2><i class="bi bi-bar-chart-fill"></i> 22.356 </h2>
                                            <h4>Visitantes</h4>
                                        </div>
                                    </div>
                                    <!--card dash-box-->
                                </div>
                                <!--col-md-3-->
                            </div>
                        </div>
                        <!--card-body-->
                    </div>
                    <!--card-->
                    <br>
                    <!--Lastest users-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Últimos usuários</h3>
                        </div>
                        <!--card-header-->
                        <div class="card-body table-responsive">
                            <?php if (mysqli_num_rows($lastUsers)) { ?>
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>

                                <?php while ($rows = mysqli_fetch_assoc($lastUsers)) { ?>
                                <tr>
                                    <td><?php echo ucfirst($rows['ds_name']); ?></td>
                                    <td><?php echo $rows['ds_email']; ?></td>
                                    <?php if ($rows['ds_status'] == "inativo") { ?>
                                    <td><button type="button"
                                            class="btn btn-danger"><?php echo ucfirst($rows['ds_status']); ?></button>
                                    </td>
                                    <?php } else if ($rows['ds_status'] == 'ativo') { ?>
                                    <td>
                                        <p class="btn btn-success"><?php echo ucfirst($rows['ds_status']); ?></p>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </table>
                            <!--table table-striped-->
                            <?php } ?>
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

    <script src="../js/bootstrap.min.js"></script>

</body>

</html>