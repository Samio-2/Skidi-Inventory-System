<?php
require_once 'functions.php';
$id = $_GET["id"];

if (delete_stok($id) > 0) {
    header("Location: stok.php");
} else {
    header("Location: stok.php");
}
