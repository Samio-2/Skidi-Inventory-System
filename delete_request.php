<?php
require_once 'functions.php';
$id = $_GET["id"];

if (delete_request($id) > 0) {
    header("Location: request.php");
} else {
    header("Location: request.php");
}
