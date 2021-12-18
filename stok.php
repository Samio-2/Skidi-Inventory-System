<?php
require_once 'functions.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
$stok = query("SELECT * FROM stok");

if (isset($_POST["submit"])) {

    if (tambah_stok($_POST) > 0) {
        header("Location: stok.php");
    } else {
        header("Location: stok.php");
    }
}

if (isset($_POST["edit"])) {

    if (ubah_stok($_POST) > 0) {
        header("Location: stok.php");
    } else {
        header("Location: stok.php");
    }
}

?>
<?php include "header.php" ?>
<!-- Page-header start -->
<div class="page-header" style="height: 100px; ">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10" style="color: black;">Persediaan Barang
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
                    <!-- Detail Produk Start -->
                    <div class="col-xl-12 col-md-12">
                        <?php
                        if (isset($_COOKIE['sukses'])) {
                            echo
                            '<div id = "sukses" class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>' . $_COOKIE['sukses'] .
                                '</div>';
                        } else if (isset($_COOKIE['gagal'])) {
                            echo
                            '<div id = "gagal" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>' . $_COOKIE['gagal'] .
                                '</div>';
                        }
                        ?>
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Persediaan Barang</h5>
                                <button type="button" class="btn" data-toggle="modal" data-target="#buatModal" data-whatever="@mdo" style="background-color: #14279B; color: white; border-radius: 5px; margin-top: -5px; margin-left: 500px; border: none;">
                                    Tambah Persediaan Barang
                                </button>
                                <div class="modal fade buatModal" id="buatModal" tabindex="-1" aria-labelledby="buatModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="buatModalLabel">Buat Persediaan Barang</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <label for="name" class="col-form-label">
                                                            Nama Barang
                                                        </label>
                                                        <input type="text" class="form-control" name="name" id="name">

                                                        <label for="quantity" class="col-form-label">
                                                            Kuantitas
                                                        </label>
                                                        <input type="text" class="form-control" name="quantity" id="quantity">

                                                    </div>
                                                    <div class="modal-footer" style="margin-top: -15px;">
                                                        <button type="button" class="btn btn-secondary" style="border-radius: 5px;" data-dismiss="modal">
                                                            Reset
                                                        </button>
                                                        <button type="submit" name="submit" class="btn" style="background-color: #14279B; color: white; border-radius: 5px; border: none;">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            <!-- Tabel Detail Produk -->
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

                                                    <div class="d-inline-block f-w-700 " style="width: 23%">
                                                        <h6>
                                                            Nama Barang
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700 " style="width: 47%">
                                                        <h6>
                                                            Kuantitas
                                                        </h6>
                                                    </div>
                                                    <div class="d-inline-block f-w-700 " style="width: 10%">
                                                        <h6>
                                                            Aksi
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($stok as $stk) : ?>
                                                <tr class="col-12">
                                                    <td>
                                                        <div class="d-inline-block f-w-700" style="width: 10%">
                                                            <h6>
                                                                <?= $i; ?>
                                                            </h6>
                                                        </div>

                                                        <div class="d-inline-block f-w-700 " style="width: 25%">
                                                            <h6>
                                                                <?= $stk["name"]; ?>
                                                            </h6>
                                                        </div>

                                                        <div class="d-inline-block f-w-700 " style="width: 44.5%">
                                                            <h6>
                                                                <?= $stk["quantity"]; ?>
                                                            </h6>
                                                        </div>
                                                        <div class="d-inline-block f-w-700 " style="width: 10%">
                                                            <h6>
                                                                <a type="button" data-toggle="modal" data-target="#ubahModalid<?= $stk["id"]; ?>" data-whatever="@mdo"><i class="fa fa-edit" style="width: 20px;"></i>
                                                                </a>
                                                                <div class="modal fade ubahModalid<?= $stk["id"]; ?>" id="ubahModalid<?= $stk["id"]; ?>" tabindex="-1" aria-labelledby="ubahModalid<?= $stk["id"]; ?>Label" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="ubahModalid<?= $stk["id"]; ?>Label">Ubah Persediaan Barang</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="" method="POST">
                                                                                    <div class="form-group">
                                                                                        <label for="name" class="col-form-label">
                                                                                            Nama Barang
                                                                                        </label>
                                                                                        <input type="hidden" name="id" value="<?= $stk["id"]; ?>">
                                                                                        <input type="text" class="form-control" name="name" id="name" value="<?= $stk["name"]; ?>">

                                                                                        <label for="quantity" class="col-form-label">
                                                                                            Kuantitas
                                                                                        </label>
                                                                                        <input type="text" class="form-control" name="quantity" id="quantity" value="<?= $stk["quantity"]; ?>">

                                                                                    </div>
                                                                                    <div class="modal-footer" style="margin-top: -15px;">
                                                                                        <button type="button" class="btn btn-secondary" style="border-radius: 5px;" data-dismiss="modal">
                                                                                            Reset
                                                                                        </button>
                                                                                        <button type="edit" name="edit" class="btn" style="background-color: #14279B; color: white; border-radius: 5px; border: none;">
                                                                                            Simpan
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a type="button" data-toggle="modal" data-target="#deleteModalid<?= $stk["id"]; ?>" data-whatever="@mdo">
                                                                    <i class="fa fa-trash" style="width: 20px;"></i>
                                                                </a>
                                                                <div class="modal fade deleteModalid<?= $stk["id"]; ?>" id="deleteModalid<?= $stk["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalid<?= $stk["id"]; ?>Label" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="deleteModalid<?= $stk["id"]; ?>Label">Delete Data</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Apakah anda yakin ingin menghapus data?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a href="delete_stok.php?id=<?= $stk["id"]; ?>" class="btn btn-danger">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                    <!-- Detail Produk End -->
                </div>
            </div>
        </div>
        <div id="styleSelector"> </div>
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

<!-- menu js -->
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/vertical/vertical-layout.min.js "></script>

<script type="text/javascript" src="assets/js/script.js "></script>
</body>

</html>