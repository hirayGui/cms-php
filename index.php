<?php

include_once 'config/Database.php';
include_once 'class/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$posts = $post->listLastPublishedPosts();


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
    <title>Home</title>
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

    <section data-bs-version="5.1" class="header14 cid-sFzxmVl7J6" id="header14-1f">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 image-wrapper">
                    <img src="assets/images/mbr-2.jpg" alt="businesscompanyallrightsreservedsoyboy">
                </div>
                <div class="col-12 col-md">
                    <div class="text-wrapper">
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong>Business Company
                                INC</strong></h1>
                        <p class="mbr-text mbr-fonts-style display-7">A Business Company trabalha na área do direito
                            empresarial e alivia as dores de cabeça do cliente, tomando conta de todos os trâmite legais
                            de sua empresa.</p>
                        <div class="mbr-section-btn mt-3"><a class="btn btn-primary display-4"
                                href="index.html#header14-1j">Saiba mais</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="features1 cid-sFzyUE9AaP" id="features1-1i">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        <strong>Nossas principais atividades</strong>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="card col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <div class="iconfont-wrapper">
                                <span class="mbr-iconfont mobi-mbri-cust-feedback mobi-mbri"></span>
                            </div>
                            <h5 class="card-title mbr-fonts-style display-5"><strong>Consultoria</strong></h5>
                            <p class="card-text mbr-fonts-style display-7">Esclarecimento dos principais aspectos da
                                legislação que impactam o dia a dia de um determinado negócio e quais são as ações que o
                                empreendedor deve tomar para evitar problemas.</p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <div class="iconfont-wrapper">
                                <span class="mbr-iconfont mobi-mbri-briefcase mobi-mbri"></span>
                            </div>
                            <h5 class="card-title mbr-fonts-style display-5"><strong>Representação da Empresa</strong>
                            </h5>
                            <p class="card-text mbr-fonts-style display-7">Contar com um suporte especializado pode
                                fazer toda a diferença na hora de evitar sanções.</p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <div class="iconfont-wrapper">
                                <span class="mbr-iconfont mobi-mbri-users mobi-mbri"></span>
                            </div>
                            <h5 class="card-title mbr-fonts-style display-5"><strong>Auditoria e Compliance</strong>
                            </h5>
                            <p class="card-text mbr-fonts-style display-7">Nesse tipo de trabalho, oferecemos não apenas
                                uma análise, como também uma orientação sobre boas práticas que a empresa deve adotar,
                                para evitar problemas jurídicos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="header14 cid-sFzz5E692j" id="header14-1j">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 image-wrapper">
                    <img src="assets/images/mbr-1.jpg" alt="Mobirise Website Builder">
                </div>
                <div class="col-12 col-md">
                    <div class="text-wrapper">
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                            <strong>Sobre</strong>
                        </h1>
                        <p class="mbr-text mbr-fonts-style display-7">Atuando há 12 anos no mercado brasileiro, a
                            Business Company é multidisciplinar com foco no ambiente contencioso e consultivo,
                            oferecendo soluções jurídicas seguras e inovadoras.
                            <br>Sediado na cidade de São Paulo, também é representado por correspondentes nas cidades de
                            Guarulhos, Gramado, Porto Walter, Itauçu e Ouro Verde.
                            <br>Atende causas de pequena, média e grande complexidades de pessoas físicas e jurídicas
                            dos mais variados segmentos.
                            <br>Como diferencial, entrega consultoria específica para empresas estrangeiras que desejam
                            se instalar em solo nacional.
                            <br>Atendimento em português, inglês ou sessoto.<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--Notícias-->
    <section data-bs-version="5.1" class="features3 cid-sFzFvgBfc0" id="features3-1p">
        <div class="container">
            <div class="mbr-section-head">
                <h4 class="mbr-section-title mbr-fonts-style align-center mb-5 display-2">
                    <strong>Notícias</strong>
                </h4>
            </div>
            <?php if (mysqli_num_rows($posts)) { ?>
            <div class="row mt-4">
                <?php while ($rows = mysqli_fetch_assoc($posts)) { ?>
                <div class="item features-image сol-12 col-md-6 col-lg-4">
                    <div class="item-wrapper">
                        <div class="item-img">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['ds_image']); ?>"
                                alt="<?php echo $rows['ds_description'] ?>" class="img-fluid rounded"
                                style='width: 336px; height: auto'>
                        </div>
                        <div class="item-content">
                            <h5 class="item-title mbr-fonts-style display-5">
                                <strong><?php echo $rows['ds_title'] ?></strong>
                            </h5>

                            <p class="mbr-text mbr-fonts-style mt-3 display-7">
                                <?php echo substr_replace($rows['ds_body'], ' ...', 75); ?></p>
                        </div>
                        <div class="mbr-section-btn item-footer mt-2"><a
                                href="post.php?id=<?php echo $rows['id_post'] ?>"
                                class="btn item-btn btn-primary display-4">Continuar lendo
                            </a></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>

    <section data-bs-version="5.1" class="team1 cid-sFzErVWEaH" id="team1-1o">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h3 class="mbr-section-title1 mbr-fonts-style align-center mb-5 display-2">
                        <strong>Equipe Business Company</strong>
                    </h3>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrap">
                        <div class="image-wrap">
                            <img src="assets/images/mbr-596x398.jpg" alt="Mobirise Website Builder">
                        </div>
                        <div class="content-wrap">
                            <h5 class="mbr-section-title card-title mbr-fonts-style align-center m-0 display-5">
                                <strong>John Smith</strong>
                            </h5>
                            <h6 class="mbr-role mbr-fonts-style align-center mb-3 display-4">
                                <strong>Estagiário</strong>
                            </h6>
                            <p class="card-text mbr-fonts-style align-center display-7">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrap">
                        <div class="image-wrap">
                            <img src="assets/images/mbr-3-596x397.jpg" alt="Mobirise Website Builder">
                        </div>
                        <div class="content-wrap">
                            <h5 class="mbr-section-title card-title mbr-fonts-style align-center m-0 display-5">
                                <strong>Sarah Palmer</strong>
                            </h5>
                            <h6 class="mbr-role mbr-fonts-style align-center mb-3 display-4">
                                <strong>Presidenta</strong>
                            </h6>
                            <p class="card-text mbr-fonts-style align-center display-7">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrap">
                        <div class="image-wrap">
                            <img src="assets/images/mbr-2-596x397.jpg" alt="Mobirise Website Builder">
                        </div>
                        <div class="content-wrap">
                            <h5 class="mbr-section-title card-title mbr-fonts-style align-center m-0 display-5">
                                <strong>James Swift</strong>
                            </h5>
                            <h6 class="mbr-role mbr-fonts-style align-center mb-3 display-4"><strong>Sócio</strong></h6>
                            <p class="card-text mbr-fonts-style align-center display-7">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrap">
                        <div class="image-wrap">
                            <img src="assets/images/mbr-596x401.jpeg" alt="Mobirise Website Builder">
                        </div>
                        <div class="content-wrap">
                            <h5 class="mbr-section-title card-title mbr-fonts-style align-center m-0 display-5">
                                <strong>Helen Smith</strong>
                            </h5>
                            <h6 class="mbr-role mbr-fonts-style align-center mb-3 display-4">
                                <strong>Sócio-Líder</strong>
                            </h6>
                            <p class="card-text mbr-fonts-style align-center display-7">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="clients1 cid-sFAw7z51L3" id="clients1-1u">
        <div class="images-container container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Nossos Clientes</strong>
                </h3>
                <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-7">Algumas das empresas
                    que fazem negócio com a Business Company</h4>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-3 card">
                    <img src="assets/images/mbr.png" alt="Mobirise Website Builder">
                </div>
                <div class="col-md-3 card">
                    <img src="assets/images/mbr-2.png" alt="Mobirise Website Builder">
                </div>
                <div class="col-md-3 card">
                    <img src="assets/images/mbr-3.png" alt="Mobirise Website Builder">
                </div>
                <div class="col-md-3 card">
                    <img src="assets/images/mbr-4.png" alt="Mobirise Website Builder">
                </div>
                <div class="col-md-3 card">
                    <img src="assets/images/mbr-5.png" alt="Mobirise Website Builder">
                </div>
                <div class="col-md-3 card">
                    <img src="assets/images/mbr-6.png" alt="Mobirise Website Builder">
                </div>
                <div class="col-md-3 card">
                    <img src="assets/images/mbr-7.png" alt="Mobirise Website Builder">
                </div>
                <div class="col-md-3 card">
                    <img src="assets/images/mbr-8.png" alt="Mobirise Website Builder">
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="contacts2 cid-sFzIA7KGYz" id="contacts2-1r">
        <!---->
        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Contato</strong>
                </h3>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5"><strong>Telefone</strong></h6>
                            <p class="mbr-text mbr-fonts-style display-7"><a href="tel:+55(11)40028922"
                                    class="text-danger">(11) 4002-8922</a></p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-letter mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Email</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">
                                <a href="mailto:info@site.com" class="text-danger">info@site.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-map-pin mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Endereço</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">
                                Rua dos Empregados, 2312 - São Paulo</p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-briefcase mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Período de atividade</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">08h00 - 17h00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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