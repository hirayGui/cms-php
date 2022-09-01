<?php
include_once('config/Database.php');
include_once('class/Post.php');

$database = new Database();
$db = $database->getConnection();
$post = new Post($db);

if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {
        $post->id = $_GET['id'];
        $resultPost = $post->selectPost();
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <!-- Site made with Mobirise Website Builder v5.6.8, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.6.8, mobirise.com">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image:src" content="">
    <meta property="og:image" content="">
    <meta name="twitter:title" content="Post">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/mbr-1.png" type="image/x-icon">
    <meta name="description" content="">


    <title>Post</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

</head>

<body>

    <section data-bs-version="5.1" class="menu menu2 cid-sFCw1qGFAI" once="menu" id="menu2-23">
        <nav class="navbar navbar-dropdown navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-7"
                            href="https://mobiri.se">BusinessCompany</a></span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse"
                    data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="index.html">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-white display-4"
                                href="index.html#header14-1j">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4"
                                href="index.html#features3-1p">Notícias</a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-white display-4"
                                href="index.html#contacts2-1r">Contato</a></li>
                    </ul>
                    <div class="icons-menu">
                        <a class="iconfont-wrapper" href="http://linkedin.com/businesscia" target="_blank">
                            <span class="p-2 mbr-iconfont socicon-linkedin socicon"></span>
                        </a>
                        <a class="iconfont-wrapper" href="http://intagram.com/businesscia" target="_blank">
                            <span class="p-2 mbr-iconfont socicon-instagram socicon"></span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <?php if (mysqli_num_rows($resultPost)) {
        $row = mysqli_fetch_assoc($resultPost); ?>
    <section data-bs-version="5.1" class="content4 cid-t6LazVBO9u" id="content4-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                        <strong><?php echo $row['ds_title']; ?></strong>
                    </h3>
                    <h4 class="mbr-section-subtitle align-center mbr-fonts-style mb-4 display-7">
                        Por <?php echo $row['author'] ?>.<br>
                        Criado em <?php echo $row['dt_created'] ?>. Atualizado em <?php echo $row['dt_updated'] ?></h4>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="image3 cid-t6LaKkb1sV" id="image3-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="image-wrapper">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['ds_image']); ?>"
                            alt="<?php echo $row['ds_description'] ?>">
                        <p class="mbr-description mbr-fonts-style mt-2 align-center display-4">
                            <?php echo $row['ds_description'] ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="content5 cid-t6Lb49u2GT" id="content5-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="mbr-text mbr-fonts-style display-7">
                        <?php echo $row['ds_body'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="content8 cid-t6Lc95MLeU" id="content8-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="counter-container col-md-12 col-lg-11">
                    <h4 class="mbr-section-title mbr-fonts-style mb-4 display-5">
                        Comentários</h4>
                    <div class="mbr-text mbr-fonts-style display-7">
                        <ul>
                            <li><strong>[usuário]&nbsp;</strong>[mensagem do usuário] Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Laboriosam eius facilis et accusantium quas quia ipsa.
                                Aliquam ut vero doloribus ipsa consequuntur minus.</li>
                            <li><strong>[usuário]&nbsp; </strong>[mensagem do usuário] Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Laboriosam eius facilis et accusantium quas quia ipsa.
                                Aliquam ut vero doloribus ipsa consequuntur minus.</li>
                            <li><strong>[usuário]&nbsp; </strong>[mensagem do usuário] Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Laboriosam eius facilis et accusantium quas quia ipsa.
                                Aliquam ut vero doloribus ipsa consequuntur minus.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="form5 cid-t6Lcbtwfl2" id="form5-6">
        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Deixe seu comentário</strong>
                </h3>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="https://mobirise.eu/" method="POST" class="mbr-form form-with-styler"
                        data-form-title="Form Name"><input type="hidden" name="email" data-form-email="true"
                            value="7no8x213CSGjHWDhvnkwrkK2Evtpr4Z1nXMQDIbGcNL5bMvyj6/vX3QwzsN0D33PLI9ISk5r58LSi6SxX8o1t/XqTqP/odLZ3Evi20Mu6HypmcU6BoG8Zh/RTq8Zo7vf">
                        <div class="row">
                            <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Agradecemos pelo
                                comentário!</div>
                            <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                                Oops...! some problem!
                            </div>
                        </div>
                        <div class="dragArea row">
                            <div class="col-md col-sm-12 form-group mb-3" data-for="name">
                                <input type="text" name="name" placeholder="Seu nome" data-form-field="name"
                                    class="form-control" value="" id="name-form5-6">
                            </div>
                            <div class="col-md col-sm-12 form-group mb-3" data-for="email">
                                <input type="email" name="email" placeholder="Seu email" data-form-field="email"
                                    class="form-control" value="" id="email-form5-6">
                            </div>
                            <div class="col-12 form-group mb-3" data-for="textarea">
                                <textarea name="textarea" placeholder="Mensagem" data-form-field="textarea"
                                    class="form-control" id="textarea-form5-6"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn"><button
                                    type="submit" class="btn btn-primary display-4">Comentar</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php } ?>

    <section data-bs-version="5.1" class="footer3 cid-sFCygHrmNf" once="footers" id="footer3-24">
        <div class="container">
            <div class="row align-center mbr-white">
                <div class="row row-links">
                    <ul class="foot-menu">
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="#top"
                                class="text-white text-primary">Home</a></li>
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="index.html#header14-1j"
                                class="text-white">Sobre</a></li>
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="index.html#features3-1p"
                                class="text-white">Notícias</a></li>
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="index.html#contacts2-1r"
                                class="text-white">Contato</a></li>
                    </ul>
                </div>
                <div class="row social-row">
                    <div class="social-list align-right pb-2">
                        <div class="soc-item">
                            <a href="http://whatsapp.com/businesscia" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-whatsapp socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="http://telegram.com/businesscia" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-telegram socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="http://linkedin.com/businesscia"><span
                                    class="mbr-iconfont mbr-iconfont-social socicon-linkedin socicon"></span></a>
                        </div>
                        <div class="soc-item">
                            <a href="http://instagram.com/businesscia" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-instagram socicon"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row row-copirayt">
                    <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7">Business Company © 2022
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="display-7"
        style="padding: 0;align-items: center;justify-content: center;flex-wrap: wrap;    align-content: center;display: flex;position: relative;height: 4rem;">
        <a href="https://mobiri.se/" style="flex: 1 1;height: 4rem;position: absolute;width: 100%;z-index: 1;"><img
                alt="" style="height: 4rem;"
                src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="></a>
        <p style="margin: 0;text-align: center;" class="display-7">Created with Mobirise &#8204;</p><a style="z-index:1"
            href="https://mobirise.com/web-page-maker.html">Free Web Page Builder</a>
    </section>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <script src="assets/formoid/formoid.min.js"></script>


    <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i
                class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>
</body>

</html>