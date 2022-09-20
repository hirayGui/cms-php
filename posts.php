<?php

include_once 'config/Database.php';
include_once 'class/Post.php';
include_once 'class/Category.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$posts = $post->listPublishedPosts();
$resultNumber = mysqli_num_rows($posts);
$resultsPerPage = 5;

$pageNumber = ceil($resultNumber / $resultsPerPage);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$pageFirstResult = ($page - 1) * $resultsPerPage;

$post->pageFirstResult = $pageFirstResult;
$post->resultsPerPage = $resultsPerPage;

$result = $post->showLimitedPosts();


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
    <meta name="twitter:title" content="Home">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/mbr-1.png" type="image/x-icon">
    <meta name="description" content="">
    <title>Notícias</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
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

    <section data-bs-version="5.1" class="menu menu2 cid-sFCw1qGFAI" once="menu" id="menu2-0">
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
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="index.php">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-white display-4"
                                href="index.php#header14-1j">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4"
                                href="#">Notícias</a>
                        </li>
                        <li class="nav-item"><a class="nav-link link text-white display-4"
                                href="index.php#contacts2-1r">Contato</a></li>
                    </ul>
                    <div class="icons-menu">
                        <a class="iconfont-wrapper" href="http://linkedin.com/businesscia" target="_blank">
                            <span class="p-2 mbr-iconfont socicon-linkedin socicon"></span>
                        </a>
                        <a class="iconfont-wrapper" href="http://intagram.com/businessciaadvogados" target="_blank">
                            <span class="p-2 mbr-iconfont socicon-instagram socicon"></span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <section data-bs-version="5.1" class="header14 cid-sFzxmVl7J6" id="header14-1f">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-md-12 col-lg-11">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-2 display-2">
                        <strong>Notícias</strong>
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <?php if (mysqli_num_rows($result)) { ?>
    <?php while ($rows = mysqli_fetch_assoc($result)) { ?>
    <section data-bs-version="5.1" class="features16 cid-tgF5Sf9tSH" id="features17-2">
        <div class="container" style="margin-bottom: 15px">
            <div class="content-wrapper">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-4">
                        <div class="image-wrapper">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['ds_image']); ?>"
                                alt="<?php echo $rows['ds_description']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-lg">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style display-5">
                                <strong><?php echo $rows['ds_title']; ?></strong>
                            </h6>
                            <div class="mbr-text mbr-fonts-style mb-4 display-4">
                                <?php echo mb_strimwidth(ucfirst($rows['ds_body']), 0, 125, '...'); ?></div>
                            <p class="mbr-text mbr-fonts-style mb-4 display-4">Publicado em
                                <?php echo $rows['dt_created'] ?></p>
                            <div class="mbr-section-btn mt-3">
                                <a class="btn btn-primary display-4" href="post.php?id=<?php echo $rows['id_post']; ?>">
                                    Continuar lendo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php if ($resultNumber > $resultsPerPage) { ?>
    <section data-bs-version="5.1" class="content12 cid-tgF7AFeMTk" id="content12-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-11">
                    <div class="mbr-section-btn align-center">
                        <?php if ($page > 1) { ?>
                        <a class="btn btn-primary display-4" href="posts.php?page=<?php echo $page - 1; ?>">Anterior</a>
                        <?php } ?>
                        <?php if(($page * $resultsPerPage) < $resultNumber){ ?>
                        <a class="btn btn-primary display-4" href="posts.php?page=<?php echo $page + 1; ?>">Próximo</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php } ?>

    <section data-bs-version="5.1" class="footer3 cid-sFCygHrmNf" once="footers" id="footer3-24">
        <div class="container">
            <div class="row align-center mbr-white">
                <div class="row row-links">
                    <ul class="foot-menu">
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="#top"
                                class="text-white text-primary">Home</a></li>
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="index.php#header14-1j"
                                class="text-white">Sobre</a></li>
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="index.php#features3-1p"
                                class="text-white">Notícias</a></li>
                        <li class="foot-menu-item mbr-fonts-style display-7"><a href="index.php#contacts2-1r"
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
                            <a href="http://instagram.com/businessciaadvogados" target="_blank">
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
        <p style="margin: 0;text-align: center;" class="display-7">Made with Mobirise &#8204;</p><a style="z-index:1"
            href="https://mobirise.com/website-design-software.html">Free Website Designer Software</a>
    </section>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i
                class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>
</body>

</html>