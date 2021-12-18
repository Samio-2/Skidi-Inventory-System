<?php
require_once 'functions.php';
$id = $_GET["id"];

if (delete_barang_masuk($id) > 0) {
    header("Location: barang_masuk.php");
} else {
    header("Location: barang_masuk.php");
}
