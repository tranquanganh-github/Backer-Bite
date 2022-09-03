<?php include 'header.php'; ?>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    session_start();
    if (!isset($_SESSION['admin_login'])) {
        header('Location: login.php');
    }
    include 'config/connect.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <?php
        $folder = isset($_GET['f']) ? $_GET['f'] : 'main';
        $file = isset($_GET['file']) ? $_GET['file'] : 'main';
        $file_path = 'layout/' . $folder . '/' . $file . '.php';
        $eror_path = 'layout/main/404.php';
        $file_exists = file_exists($file_path) ? $file_path : $eror_path;
        include $file_exists;
        ?>
        <!-- /.card-body -->
        <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; ?>