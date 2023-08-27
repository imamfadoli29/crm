<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CRM - Dealer Motor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="body-bg">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
        <?php include 'header.php'; ?>
        <!-- header area end -->
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="container">
                <div class="row">
                    <!-- seo fact area start -->

                    <div class="col-lg-8">
                        <div class="row">
                        <?php if(!isset($_GET['menu'])){ ?>
                            <div class="col-md-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="text-center">Silahkan pilih menu</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5 mb-3">
                                <a href="index.php?menu=feedback">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="ti-thumb-up"></i> Feedback</div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-6 mt-md-5 mb-3">
                                <a href="index.php?menu=order">
                                <div class="card">
                                    <div class="seo-fact sbg2">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-shopping-cart"></i> Order</div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-2 mb-3">
                                <a href="index.php?menu=myorder">
                                <div class="card">
                                    <div class="seo-fact sbg3">
                                        <div class="p-4 justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-shopping-cart"></i>My Order</div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-2 mb-3">
                                <a href="index.php?menu=myprofile">
                                <div class="card">
                                    <div class="seo-fact sbg4">
                                        <div class="p-4 justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-user"></i>My Profile</div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>


                            <?php if(isset($_GET['menu'])){
                                if($_GET['menu'] == "feedback"){
                                    include 'feedback.php';
                                }
                                else if($_GET['menu'] == "order"){
                                    include 'order.php';
                                }
                                else if($_GET['menu'] == "myorder"){
                                    include 'myorder.php';
                                }
                                else if($_GET['menu'] == "myprofile"){
                                    include 'myprofile.php';
                                }
                            } ?>

                        </div>
                    </div>
                    <!-- seo fact area end -->
                    <!-- Social Campain area start -->
                    <div class="col-lg-4 mt-5">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h3 class="text-center mb-3">Info CRM</h3>
                                <table class="table">
                                    <th>Username</th>
                                    <td>: <?= $_SESSION['username'] ?>
                                    <tr>
                                    <th>Email</th>
                                    <td>: <?= $_SESSION['email'] ?>
                                    <tr>
                                    <th>Date Registered</th>
                                    <td>: <?= $_SESSION['date_registered'] ?>
                                    <tr>
                                    <th>Role</th>
                                    <td>: <?= $_SESSION['role'] ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Social Campain area end -->
                    </div>
                    <!-- testimonial area end -->
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
    <!-- main wrapper start -->
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="../assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="../assets/js/pie-chart.js"></script>
    <!-- all bar chart -->
    <script src="../assets/js/bar-chart.js"></script>
    <!-- all map chart -->
    <script src="../assets/js/maps.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(document).ready(function() {
            $('#dataTable1').DataTable();
        });
        $(document).ready(function() {
            $('#dataTable2').DataTable();
        });
        $(document).ready(function() {
            $('#dataTable3').DataTable();
        });
    </script>

    <script src="../assets/datatables/jquery.dataTables.js"></script>
    <script src="../assets/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>
