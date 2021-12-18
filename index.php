<?php
require_once 'functions.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
}
$masuk = query("SELECT barang_masuk.id, barang_masuk.id_stok, stok.name, barang_masuk.vendor, barang_masuk.quantity, barang_masuk.date  FROM barang_masuk JOIN stok WHERE barang_masuk.id_stok = stok.id");
$keluar = query("SELECT barang_keluar.id, barang_keluar.id_stok, stok.name, barang_keluar.quantity, barang_keluar.date  FROM barang_keluar JOIN stok WHERE barang_keluar.id_stok = stok.id");
$stok = query("SELECT * FROM stok");

$jumlah = mysqli_query($conn, "SELECT * FROM stok");
while ($data = mysqli_fetch_array($jumlah)) {
    $total[] = $data['quantity'];
}
$stok2 = array_sum($total);
$persen2 = $stok2 / 1000 * 100;

?>


<?php include "header.php" ?>

<!-- Page-header start -->
<div class="page-header" style="height: 100px; ">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10" style="color: black;">Dashboard Persediaan
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
                    <!-- Area Chart Start -->
                    <div class="col-xl-12">
                        <div class="card proj-progress-card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <h6>Persediaan Barang</h6>
                                        <h6 class="m-b-30 f-w-700"><?= number_format($stok2, 0, ',', '.') ?> dari 1.000</h6>
                                        <div class="progress">
                                            <div class="progress bg-c-red" style="width: <?= $persen2; ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Riwayat Barang Masuk</h5>
                            </div>
                            <!-- Tabel Detail Produk -->
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0 without-header">
                                        <tbody>
                                            <tr class="col-12">
                                                <td style="background-color: rgb(236, 236, 236);">
                                                    <div class="d-inline-block f-w-700" style="width: 27%">
                                                        <h6>
                                                            Tanggal
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 39%">
                                                        <h6>
                                                            Nama Barang
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 17%">
                                                        <h6>
                                                            Kuantitas
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php foreach ($masuk as $msk) : ?>
                                                <tr class="col-12">
                                                    <td>
                                                        <div class="d-inline-block f-w-700" style="width: 27%">
                                                            <h6>
                                                                <?= $msk['date']; ?>
                                                            </h6>
                                                        </div>

                                                        <div class="d-inline-block f-w-700 " style="width: 44%">
                                                            <h6>
                                                                <?= $msk["name"]; ?>
                                                            </h6>
                                                        </div>
                                                        <div class="d-inline-block f-w-700 " style="width: 14%">
                                                            <h6>
                                                                <?= $msk["quantity"]; ?>
                                                            </h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Riwayat Barang Keluar</h5>
                            </div>
                            <!-- Tabel Detail Produk -->
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0 without-header">
                                        <tbody>
                                            <tr class="col-12">
                                                <td style="background-color: rgb(236, 236, 236);">
                                                    <div class="d-inline-block f-w-700" style="width: 27%">
                                                        <h6>
                                                            Tanggal
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 39%">
                                                        <h6>
                                                            Nama Barang
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 17%">
                                                        <h6>
                                                            Kuantitas
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php foreach ($keluar as $klr) : ?>
                                                <tr class="col-12">
                                                    <td>
                                                        <div class="d-inline-block f-w-700" style="width: 27%">
                                                            <h6>
                                                                <?= $klr['date']; ?>
                                                            </h6>
                                                        </div>

                                                        <div class="d-inline-block f-w-700 " style="width: 44%">
                                                            <h6>
                                                                <?= $klr["name"]; ?>
                                                            </h6>
                                                        </div>
                                                        <div class="d-inline-block f-w-700 " style="width: 14%">
                                                            <h6>
                                                                <?= $klr["quantity"]; ?>
                                                            </h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Persediaan Barang</h5>
                            </div>
                            <!-- Tabel Detail Produk -->
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0 without-header">
                                        <tbody>
                                            <tr class="col-12">
                                                <td style="background-color: rgb(236, 236, 236);">
                                                    <div class="d-inline-block f-w-700" style="width: 20%">
                                                        <h6>
                                                            No
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 39%">
                                                        <h6>
                                                            Nama Barang
                                                        </h6>
                                                    </div>

                                                    <div class="d-inline-block f-w-700 " style="width: 17%">
                                                        <h6>
                                                            Kuantitas
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($stok as $stk) : ?>
                                                <tr class="col-12">
                                                    <td>
                                                        <div class="d-inline-block f-w-700" style="width: 20%">
                                                            <h6>
                                                                <?= $i; ?>
                                                            </h6>
                                                        </div>

                                                        <div class="d-inline-block f-w-700 " style="width: 44%">
                                                            <h6>
                                                                <?= $stk["name"]; ?>
                                                            </h6>
                                                        </div>
                                                        <div class="d-inline-block f-w-700 " style="width: 14%">
                                                            <h6>
                                                                <?= $stk["quantity"]; ?>
                                                            </h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pemasaran Produk End -->
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