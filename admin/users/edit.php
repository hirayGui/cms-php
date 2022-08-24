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

if (!$user->isAdmin()) {
    header('Location: index.php?error=Você não tem permissão para realizar esta ação!');
}

if (isset($_GET['id'])) {
    $user->id = $_GET['id'];
    $resultUser = $user->selectUser();
} else {
}

$usersCount = $user->listUsersNumber();
$postsCount = $post->listPostsNumber();

$errorMessage = '';

$space = $database->freeSpace();

//Updating user
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role']) && isset($_POST['status'])) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']) && !empty($_POST['status'])) {
        $user->id = $_POST['id'];
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->role = $_POST['role'];
        $user->status = $_POST['status'];
        if ($user->update()) {
            header('Location: index.php?success=Usuário editado com sucesso!');
        } else {
            $errorMessage = 'Ocorreu um erro!';
        }
    } else {
        $errorMessage = "Favor preencher todos os campos!";
    }
}

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Editar usuário</title>

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
                <div class="col-md-10">
                    <h1><i class="bi bi-people-fill"> </i>Usuários</h1>
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
                <li class="breadcrumb-item" aria-current="page"><a href="index.php">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar usuário</li>
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
                        <a href="../posts/index.php" class="list-group-item list-group-item-action"><i
                                class="bi bi-newspaper"></i> Posts <span
                                class="badge text-bg-secondary"><?php echo $postsCount; ?></span></a>
                        <a href="index.php" class="list-group-item list-group-item-action active main-color-bg"
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
                    <h3>Editar usuário</h3>
                    <?php if ($errorMessage != '') { ?>
                    <div id="error-alert" class="alert alert-danger col-sm-12">
                        <i class="bi bi-exclamation-triangle"></i> <?php echo $errorMessage; ?>
                    </div>
                    <!--error-alert-->
                    <?php } ?>
                    <?php if (mysqli_num_rows($resultUser)) {
                        $rows = mysqli_fetch_assoc($resultUser);
                    ?>
                    <form action="#" method="post" id="editUser" role="form" class="card needs-validation" novalidate>
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-12 form-floating">
                                    <input type="text" name="name" id="name" placeholder="Informe o nome"
                                        class="form-control" value='<?php echo $rows['ds_name'] ?>' required>
                                    <label for="name">Nome</label>
                                    <div class="invalid-feedback">Nome inválido!</div>
                                </div>
                                <!--col-12-->
                                <div class="col-md-6 form-floating">
                                    <input type="email" name="email" id="email" placeholder="Informe o email"
                                        class="form-control" value='<?php echo $rows['ds_email'] ?>' required>
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback">Formato de email inválido!</div>
                                </div>
                                <!--col-md-6-->
                                <div class="col md-6 form-floating">
                                    <input type="password" name="password" id="password" placeholder="Informe a senha"
                                        class="form-control" value='<?php echo $rows['ds_password'] ?>' required>
                                    <label for="email">Senha</label>
                                    <div class="invalid-feedback">Senha inválida!</div>
                                </div>
                                <!--col-md-6-->
                                <div class="col-md-6 form-floating">
                                    <select class="form-select" aria-label=".form-select-lg example"
                                        placeholder=" Escolha o tipo de usuário" id="role" name="role">
                                        <?php if ($rows['ds_role'] == 'user') { ?>
                                        <option value="user" selected>Usuário (padrão)</option>
                                        <option value="admin">Administrador</option>
                                        <?php } else { ?>
                                        <option value="user">Usuário (padrão)</option>
                                        <option value="admin" selected>Administrador</option>
                                        <?php } ?>
                                    </select>
                                    <label>Tipo de usuário</label>
                                </div>
                                <!--col-md-6-->
                                <div class="col-md-4"><label>Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status"
                                            <?php if ($rows['ds_status'] == 'ativo') { ?> checked<?php } ?>
                                            value="ativo">
                                        <label class="form-check-label" for="status">
                                            Ativo
                                        </label>
                                    </div>
                                    <!--form-check-->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status"
                                            <?php if ($rows['ds_status'] == 'inativo') { ?> checked<?php } ?>
                                            value="inativo">
                                        <label class="form-check-label" for="status">
                                            Inativo
                                        </label>
                                    </div>
                                    <!--form-check-->
                                    <div class="col-12">
                                        <input type="text" name="id" id="id" class="form-control" hidden
                                            value='<?php echo $rows['id_user'] ?>'>
                                    </div>
                                </div>
                                <!--col-md-4-->
                                <div class="col-md-2"></div>
                                <!--col-md-2-->
                                <div class="col-12">
                                    <input type="submit" value="Atualizar" class="btn btn-primary main-color-bg"> <a
                                        href="index.php" class="btn btn-outline-dark">Voltar</a>
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