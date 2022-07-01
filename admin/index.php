<?php
include_once '../config/Database.php';
include_once '../class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//verifying if user is logged in
if ($user->loggedIn()) {
    header('Location: home.php');
}

$loginMessage = '';
if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    if ($user->login()) {
        header('Location: home.php');
    } else {
        $loginMessage = 'Login inválido! Por favor, tente novamente.';
    }
} else {
    $loginMessage = 'Favor preencher todos os campos!';
}

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Login</title>

    <!--Importing Bootstrap-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <link rel="shortcut icon" href="../assets/images/mbr-1.png" type="image/x-icon">
    <!--Importing icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

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
        </div>
        <!--collapse navbar-nav-->
    </nav>
    <!--navbar navbar-expand-md-->

    <!--Main message-->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"></i>Painel de Controle <small>Login</small></h1>
                </div>
                <!--col-md-10-->
            </div>
            <!--row-->
        </div>
        <!--container-->
    </header>
    <!--header-->

    <!--Main section-->
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h3>Login</h3>
                    <?php if ($loginMessage != '') { ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <?php echo $loginMessage; ?>
                    </div>
                    <!--login-alert-->
                    <?php } ?>
                    <form method="POST" id="login" class="well" action="" role="form">
                        <div class="form-group">
                            <label>Email</label>
                            <input required type="text" class="form-control" placeholder="Insira seu email" name="email"
                                value='<?php if (!empty($_POST["email"])) {
                                                                                                                                    echo $_POST["email"];
                                                                                                                                } ?>'>
                        </div>
                        <!--form-group-->
                        <div class="form-group">
                            <label>Senha</label>
                            <input required type="password" class="form-control" placeholder="Insira sua senha"
                                name="password"
                                value='<?php if (!empty($_POST["password"])) {
                                                                                                                                            echo $_POST["password"];
                                                                                                                                        } ?>'>
                        </div>
                        <!--form-group-->
                        <input type="submit" class="btn btn-default btn-block" name="login" value="Login">

                    </form>
                    <!--login-->
                </div>
                <!--col-md-4 col-md-offset-4-->
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