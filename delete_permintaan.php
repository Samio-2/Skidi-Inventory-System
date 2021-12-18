<?php
require_once 'functions.php';
$id = $_GET["id"];

if (delete_permintaan($id) > 0) {
    header("Location: permintaan.php");
} else {
    header("Location: permintaan.php");
}
