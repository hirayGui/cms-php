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

if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
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
    <link rel="shortcut icon" href="../assets/images/mbr-1.png" type="image/x-icon">
    <!--Importing icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!--Importing custom styles-->
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <style>
    body {
        padding-top: 40px;
        padding-bottom: 40px;
    }

    #main {
        padding: 15px;
        max-width: 330px;
    }

    #email {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    #password {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    </style>
</head>

<body class="text-center">



    <!--Main section-->
    <section id="main" class="w-100 m-auto">
        <h3 class="mb-3 fw-normal">Login</h3>
        <?php if ($loginMessage != '') { ?>
        <div id="login-alert" class="alert alert-danger col-sm-12">
            <?php echo $loginMessage; ?>
        </div>
        <!--login-alert-->
        <?php } ?>
        <form method="POST" id="login" class="well" action="" role="form">
            <div class="form-floating">
                <input required type="text" class="form-control" placeholder="Insira seu email" name="email" id="email"
                    value='<?php if (!empty($_POST["email"])) {
                                                                                                                                    echo $_POST["email"];
                                                                                                                                } ?>'>
                <label for="email">Email</label>
            </div>
            <!--form-floating-->
            <div class="form-floating">
                <input required type="password" class="form-control" placeholder="Insira sua senha" name="password"
                    id="password"
                    value='<?php if (!empty($_POST["password"])) {
                                                                                                                                                echo $_POST["password"];
                                                                                                                                            } ?>'>
                <label for="password">Senha</label>
            </div>
            <!--form-floating-->
            <br>
            <div class="d-grid gap-4 col-12 mx-auto">
                <input type="submit" class="w-100 btn btn-primary btn-block main-color-bg" name="login" value="Login">
            </div>
            <!--d-grid gap-4 col-12 mx-auto-->

        </form>
        <!--login-->
    </section>
    <!--main-->


    <!--Footer-->
    <footer id="footer" class="fixed-bottom footer py-3">
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