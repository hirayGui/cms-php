<?php
include_once '../../config/Database.php';
include_once '../../class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//verifying if user is logged in
if (!$user->loggedIn()) {
    header('Location: ../index.php');
}

if (!$user->isAdmin()) {
    header('Location: index.php');
}

$errorMessage = '';
$result = $user->listUsers();
$usersCount = mysqli_num_rows($result);

$space = $database->freeSpace();

//creating user
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']) && !empty($_POST['status'])) {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->role = $_POST['role'];
    $user->status = $_POST['status'];
    if ($user->insert()) {
        header('Location: index.php?success=Usuário criado com sucesso!');
    } else {
        $errorMessage = 'Ocorreu um erro!';
    }
} else {
    $errorMessage = "Favor preencher todos os campos!";
}
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Adicionar usuário</title>

    <!--Importing Bootstrap-->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

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
                <div class="col-md-10">
                    <h1><i class="bi bi-people-fill"></i>Usuários <small>Criar um novo usuário</small></h1>
                </div>
                <!--col-md-10-->
            </div>
            <!--row-->
        </div>
        <!--container-->
    </header>
    <!--header-->

    <!--Breadcrumb-->
    <section id="breadcrumb-divider">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php">Usuários</a></li>
                <lo class="breadcrumb-item active">Criar novo usuário</lo>
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
                        <a href="../home.php" class="list-group-item list-group-item-action">
                            <i class="bi bi-house"></i> Home
                        </a>
                        <a href="../pages/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-file-earmark"></i> Páginas <span class="badge">3</span></a>
                        <a href="../posts/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-newspaper"></i> Posts <span class="badge">3</span></a>
                        <a href="index.php" class="list-group-item list-group-item-action active main-color-bg"
                            aria-current="true"><i class="bi bi-people-fill"></i> Usuários <span
                                class="badge"><?php echo $usersCount; ?></span></a>
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
                    <h3>Cadastro de novo usuário</h3>
                    <?php if ($errorMessage != '') { ?>
                    <div id="error-alert" class="alert alert-danger col-sm-12">
                        <?php echo $errorMessage; ?>
                    </div>
                    <!--error-alert-->
                    <?php } ?>
                    <form action="" method="post" id="createUser" role="form" class="well">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name">Informe o nome</label>
                                <input type="text" name="name" id="name" placeholder="Informe o nome"
                                    class="form-control">
                            </div>
                            <!--col-12-->
                            <div class="col-md-6">
                                <label for="email">Informe o email</label>
                                <input type="email" name="email" id="email" placeholder="Informe o email"
                                    class="form-control">
                            </div>
                            <!--col-md-6-->
                            <div class="col md-6">
                                <label for="email">Informe a senha</label>
                                <input type="password" name="password" id="password" placeholder="Informe a senha"
                                    class="form-control">
                            </div>
                            <!--col-md-6-->
                            <div class="col-md-6">
                                <label>Tipo de usuário</label>
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example
                                    placeholder=" Escolha o tipo de usuário" id="role" name="role">
                                    <option value="user" selected>Usuário (padrão)</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <!--col-md-6-->
                            <div class="col-md-4"><label>Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" checked
                                        value="ativo">
                                    <label class="form-check-label" for="status">
                                        Ativo
                                    </label>
                                </div>
                                <!--form-check-->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status"
                                        value="inativo">
                                    <label class="form-check-label" for="status">
                                        Inativo
                                    </label>
                                </div>
                                <!--from-check-->
                            </div>
                            <!--col-md-4-->
                            <div class="col-md-2"></div>
                            <!--col-md-2-->
                            <div class="col-12">
                                <input type="submit" value="Cadastrar" class="btn btn-primary main-color-bg"> <a
                                    href="index.php" class="btn btn-default">Voltar</a>
                            </div>
                        </div>
                        <!--row g-3-->
                    </form>
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
    <script src="../../js/bootstrap.min.js"></script>

</body>

</html>