<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CRM - Dealer Motor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<?php require_once 'library/Crm.php';
$crm = new Crm; ?>

<body class="body-bg">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
        <!-- main header area start -->
        <div class="mainheader-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="index.html"><img src="assets/images/icon/logo2.png" alt="logo"></a>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-9 clearfix text-right">
                        <div class="d-md-inline-block d-block mr-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header area end -->
        <!-- header area start -->
        <div class="header-area header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9  d-none d-lg-block">
                        <div class="horizontal-menu">
                            <nav>
                                <ul id="nav_menu">
                                    <li><a href="login.php"><i class="fa fa-sign-in"></i> <span>Login</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- mobile_menu -->
                    <div class="col-12 d-block d-lg-none">
                        <div id="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header area end -->
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="container">
                <div class="row my-4">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center">PROMO HOT DEALS!</h2>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['successy'])) {
                            echo '<div class="alert alert-success my-4">' . $_SESSION['successy'] . '</div>';
                            unset($_SESSION['successy']);
                        } else if (isset($_SESSION['warningy'])) {
                            echo '<div class="alert alert-warning my-4">' . $_SESSION['warningy'] . '</div>';
                            unset($_SESSION['warningy']);
                        } ?>
                    </div>
                    <?php foreach ($crm->getPromo() as $data) { ?>
                        <div class="col-md-4">
                            <div class="card" style="height:320px;">
                                <div class="card-header bg-primary text-white">
                                    <h3>
                                        <?= $data['nama_promo']; ?>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <?= $data['deskripsi_promo'] ?>
                                    </p><br>
                                    <a data-toggle="modal" data-target="#exampleModalLongy<?= $data['id_promo'] ?>" href="#"
                                        class="btn btn-primary text-center"><i class="fa fa-like"></i> Tertarik</a>
                                </div>
                                <div class="card-footer bg-primary">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-white"><i class="fa fa-calendar"></i>
                                                <?= date('d F Y', strtotime($data['dari_tgl'])) ?> -
                                                <?= date('d F Y', strtotime($data['sampai_tgl'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php
                if ($crm->getPromo()->num_rows == 0) {
                    echo '<div class="alert alert-warning text-center">Promo kosong</div>';
                } ?>
                <div class="row my-4">
                    <div class="col-md-12 mb-4 my-4">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center">PRODUK KAMI</h2>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['successx'])) {
                            echo '<div class="alert alert-success my-4">' . $_SESSION['successx'] . '</div>';
                            unset($_SESSION['successx']);
                        } else if (isset($_SESSION['warningx'])) {
                            echo '<div class="alert alert-warning my-4">' . $_SESSION['warningx'] . '</div>';
                            unset($_SESSION['warningx']);
                        } ?>
                    </div>
                    <?php foreach ($crm->getProduct() as $data) { ?>
                        <div class="col-md-4">
                            <div class="card" style="height:300px;">
                                <div class="card-header bg-primary text-white">
                                    <h3>
                                        <?= $data['nama_produk']; ?>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <img style="height:120px;width:150px;" class="img-fluid img-thumbnail"
                                                src="assets/foto/<?= $data['foto_produk'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php if (strlen($data['deskripsi_produk']) > 90) {
                                                    echo substr($data['deskripsi_produk'], 0, 90) . "...";
                                                } else {
                                                    echo $data['deskripsi_produk'];
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                    <a data-toggle="modal" data-target="#exampleModalLongx<?= $data['id_produk'] ?>"
                                        href="#" class="btn btn-primary text-center"><i class="fa fa-like"></i> Tertarik</a>
                                </div>
                                <div class="card-footer bg-primary">
                                    <p class="text-white"><i class="fa fa-dollar"></i>
                                        <?= "Rp. " . number_format($data['harga_produk'], 0, '.', '.'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php
                if ($crm->getProduct()->num_rows == 0) {
                    echo '<div class="alert alert-warning text-center">Produk kosong</div>';
                } ?>
            </div>
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
        </div>
    </footer>
    <!-- footer area end-->
    </div>

    <?php foreach ($crm->getProduct() as $data) { ?>
        <div class="modal fade" id="exampleModalLongx<?= $data['id_produk'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Peminat</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="controller/Data_crm.php?action=kirim_minat&id=<?= $data['id_produk']; ?>"
                            method="POST">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama lengkap anda..."><br>
                            <label>Nomor Handphone</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="Nomor handphone anda...">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="proses" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php foreach ($crm->getPromo() as $data) { ?>
        <div class="modal fade" id="exampleModalLongy<?= $data['id_promo'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Peminat</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="controller/Data_crm.php?action=kirim_minat_promo&id=<?= $data['id_promo']; ?>"
                            method="POST">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama lengkap anda..."><br>
                            <label>Nomor Handphone</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="Nomor handphone anda...">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="proses" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <!-- main wrapper start -->
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- all bar chart -->
    <script src="assets/js/bar-chart.js"></script>
    <!-- all map chart -->
    <script src="assets/js/maps.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>