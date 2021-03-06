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
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!--Importing icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/images/mbr-1.png" type="image/x-icon">

    <!--Importing custom styles-->
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-md navbar-default">
        <a class="navbar-brand" href="#">Painel de Controle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--navbar-toggler-->

        <!--Navbar items-->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
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
    </nav>
    <!--navbar navbar-expand-md-->

    <!--Main message-->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><i class="bi bi-house"></i>Home <small>Gerencie seu site</small></h1>
                </div>
                <!--col-md-10-->
            </div>
            <!--row-->
        </div>
        <!--container-->
    </header>
    <!--header-->

    <!--Breadcrumb-->
    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="active">Home</li>
            </ol>
        </div>
        <!--container-->
    </section>
    <!--bradcrumb-->

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
                                class="bi bi-file-earmark"></i> Páginas <span class="badge">3</span></a>
                        <a href="posts/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-newspaper"></i> Posts <span class="badge">5</span></a>
                        <a href="users/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-people-fill"></i> Usuários <span
                                class="badge"><?php echo $usersCount ?></span></a>
                    </div>
                    <!--list-group-->

                    <!--Progress bar showing how full the database is-->
                    <div class="well">
                        <h4>Espaço livre no banco <?php echo round($space, 2) ?>%</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo round($space, 2) ?>%;"
                                aria-valuenow="<?php echo round($space, 2) ?>" aria-valuemin="0" aria-valuemax="100">
                                <?php echo round($space, 2) ?>%</div>
                        </div>
                        <!--progress-->
                    </div>
                    <!--well-->

                </div>
                <!--col-md-3-->
                <div class="col-md-9">
                    <!--Cards showing simplified statistics-->
                    <div class="card">
                        <div class="card-header main-color-bg">
                            <h5>Visão Geral</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><i class="bi bi-people-fill"></i> <?php echo $usersCount ?> </h2>
                                    <h4>Usuários</h4>
                                </div>
                                <!--well dash-box-->
                            </div>
                            <!--col-md-3-->
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><i class="bi bi-file-earmark"></i> 3 </h2>
                                    <h4>Páginas</h4>
                                </div>
                                <!--well dash-box-->
                            </div>
                            <!--col-md-3-->
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><i class="bi bi-newspaper"></i> 5 </h2>
                                    <h4>Posts</h4>
                                </div>
                                <!--well dash-box-->
                            </div>
                            <!--col-md-3-->
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><i class="bi bi-bar-chart-fill"></i> 22.356 </h2>
                                    <h4>Visitantes</h4>
                                </div>
                                <!--well dash-box-->
                            </div>
                            <!--col-md-3-->
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
                                    <td><?php echo ucfirst($rows['ds_status']); ?></td>
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
    <footer id="footer">
        <p id="copyright">Business Company &copy;
            <!--Script gets current year-->
            <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
        </p>
    </footer>

    <!--Importing scripts-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>