<?php

require_once 'functions.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
}

?>


<?php include "header.php" ?>
<!-- Page-header start -->
<div class="page-header" style="height: 100px; ">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10" style="color: black;">Laporan Persediaan
                        <span style="font-size: 12px; font-weight: 500; border-radius: 50px; background-color: rgb(253, 253, 119); padding: 5px 10px; color: red;">
                            Staff Inventory
                        </span>
                    </h5>
                </div>
            </div>
            <div class="col-md-4">
                <form class="form-material">
                    <div class="form-group form-primary">
                        <input type="text" name="footer-email" class="form-control" style=" border-radius: 5px; border-color: rgb(224, 222, 222); box-shadow: 3px 3px 6px rgb(236, 236, 236);">
                        <span class="form-bar"></span>
                        <label class="float-label" style="margin-left: 15px; color: rgb(199, 194, 194);"><i class="fa fa-search m-r-10" style="color: black;"></i>
                            Search
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <!-- Material statustic card start -->
                    <div class="col-xl-12 col-md-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Laporan Persediaan</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                        <li><i class="fa fa-trash close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0 without-header">
                                        <tbody>
                                            <tr class="col-12">
                                                <td style="background-color: rgb(236, 236, 236);">
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            No
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 70%">
                                                        <h6>
                                                            Laporan
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 10%">
                                                        <h6>
                                                            Cetak
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            1
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 71%">
                                                        <h6>
                                                            Laporan Persediaan Barang
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            <a href="stok_print.php"><i class="fa fa-print"></i></a>
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            2
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 71%">
                                                        <h6>
                                                            Laporan Barang Masuk
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            <a href="barang_masuk_print.php"><i class="fa fa-print"></i></a>
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            3
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 71%">
                                                        <h6>
                                                            Laporan Barang Keluar
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            <a href="barang_keluar_print.php"><i class="fa fa-print"></i></a>
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            4
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 71%">
                                                        <h6>
                                                            Laporan Request Barang
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            <a href="request_print.php"><i class="fa fa-print"></i></a>
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            5
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 71%">
                                                        <h6>
                                                            Laporan Permintaan Pembelian
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700" style="width: 10%">
                                                        <h6>
                                                            <a href="permintaan_print.php"><i class="fa fa-print"></i></a>
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Required Jquery -->
<script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
<script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- slimscroll js -->
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
<!-- Morris Chart js -->
<script src="assets/js/raphael/raphael.min.js"></script>
<script src="assets/js/morris.js/morris.js"></script>
<!-- Custom js -->
<script src="assets/pages/chart/morris/morris-custom-chart.js"></script>

<!-- menu js -->
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/vertical/vertical-layout.min.js "></script>

<script type="text/javascript" src="assets/js/script.js "></script>
</body>

</html>