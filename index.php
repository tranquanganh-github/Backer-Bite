<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include 'config/connect.php'; ?>

<!-- /.card-header -->
<?php include 'header.php'; ?>

<!-- /.card-body -->
<?php
$folder = isset($_GET['f']) ? $_GET['f'] : 'main';
$file = isset($_GET['file']) ? $_GET['file'] : 'main';
$file_path = 'layout/' . $folder . '/' . $file . '.php';
$eror_path = 'layout/main/404.php';
$file_exists = file_exists($file_path) ? $file_path : $eror_path;
include $file_exists;
?>

<!-- /.card-footer-->
<?php include 'footer.php'; ?>

<script src="./js/main.js"></script>
<!-- slides per group JS  -->


