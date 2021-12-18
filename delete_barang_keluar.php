<?php
require_once 'functions.php';
$id = $_GET["id"];

if (delete_barang_keluar($id) > 0) {
    header("Location: barang_keluar.php");
} else {
    header("Location: barang_keluar.php");
}
