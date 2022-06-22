<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel de Controle | Páginas</title>

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
    <nav class="navbar navbar-expand-md navbar-default">
        <a class="navbar-brand" href="#">Painel de Controle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--navbar-toggler-->

        <!--Navbar items-->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../home.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Páginas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../posts/index.php">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../users/index.php">Usuários</a>
                </li>
            </ul>
            <ul class="navbar-right navbar-nav nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary" href="../index.php">Sair</a>
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
                    <h1><i class="bi bi-gear-fill"></i>Páginas <small>Gerencie as páginas do seu site</small></h1>
                </div>
                <!--col-md-10-->
                <div class="col-md-2">
                    <div class="dropdown create">
                        <!--Actions menu-->
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                            Adicionar
                        </button>
                        <!--btn dropdown-toggle-->
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="../posts/create.php">Adicionar post</a></li>
                            <li><a class="dropdown-item" href="../users/create.php">Adicionar usuário</a></li>
                        </ul>
                        <!--dropdown-menu-->
                    </div>
                    <!--dropdown-->
                </div>
                <!--col-md-2-->
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
                <li class="breadcrumb-item active">Páginas</li>
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
                            <i class="bi bi-gear-fill"></i> Home
                        </a>
                        <a href="index.php" class="list-group-item list-group-item-action active main-color-bg" aria-current="true"><i class="bi bi-file-earmark"></i> Páginas <span class="badge">3</span></a>
                        <a href="../posts/index.php" class="list-group-item list-group-item-action"><i class="bi bi-newspaper"></i> Posts <span class="badge">5</span></a>
                        <a href="../users/index.php" class="list-group-item list-group-item-action"><i class="bi bi-people-fill"></i> Usuários <span class="badge">2</span></a>
                    </div>
                    <!--list-group-->

                    <!--Progress bar showing how full the database is-->
                    <div class="well">
                        <h4>Espaço utilizado no banco</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
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
                            <h5>Visão Geral | Páginas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Filtrar páginas">
                                </div>
                                <!--col-md-12-->
                            </div>
                            <!--row-->
                            <br>
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Título</th>
                                    <th>Status</th>
                                    <th>Data de Criação</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Home</td>
                                    <td>Publicado</td>
                                    <td>22 de junho</td>
                                    <td><a href="edit.php" class="btn btn-default">Editar</a>
                                        <a href="#" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sobre</td>
                                    <td>Publicado</td>
                                    <td>5 de maio</td>
                                    <td><a href="edit.php" class="btn btn-default">Editar</a>
                                        <a href="#" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contato</td>
                                    <td>Não publicado</td>
                                    <td>28 de janeiro</td>
                                    <td><a href="edit.php" class="btn btn-default">Editar</a>
                                        <a href="#" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            </table>
                            <!--table table-striped-->
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>