<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Login</title>

    <!--Importing Bootstrap-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!--Importing icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!--Importing custom styles-->
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-md navbar-default">
        <a class="navbar-brand" href="#">Painel de Controle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
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
                    <form action="home.php" id="login" class="well">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Insira seu email" name="email">
                        </div>
                        <!--form-group-->
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" placeholder="Insira sua senha" name="password">
                        </div>
                        <!--form-group-->
                        <button type="submit" class="btn btn-default btn-block">Login</button>
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
        <p id="copyright">Admin Copyright &copy;
            <!--Script gets current year-->
            <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
        </p>
    </footer>

    <!--Importing scripts-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>