<?php
$limit = 8;
$isFavorited = 1;
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
// if ($page == 1) {
//     $key = 0;
// } else {
//     $key = ($page - 1) * $limit;
// }
// $offset = ($page - 1) * $limit;
// echo $offset;
// $statement_all_items = $conn->prepare("SELECT * FROM products WHERE isFavorited = :isFavorited");
// $statement_all_items->bindParam(':isFavorited', $isFavorited);
// $statement_all_items->execute();
// $count_all_items = $statement_all_items->rowCount();
// $totalPage = ceil($count_all_items / $limit);
$statement = $conn->prepare('SELECT * FROM products WHERE isFavorited = :isFavorited LIMIT :limit');
$statement->bindParam(':isFavorited', $isFavorited);
// $statement->bindParam(':offset', $limit, PDO::PARAM_INT);
$statement->bindParam(':limit', $limit, PDO::PARAM_INT);
$statement->execute();
$all_items = $statement->fetchAll();

?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- <div class="row"> -->
        <!-- <div class="col-lg-6"> -->
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Products Favorited</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th>COUNT</th>
                            <th>PRICE</th>
                            <th>FAVORTIED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $key = 0;?>
                        <?php foreach ($all_items as $row) { ?>
                            <tr>
                                <td><?php echo $key ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['count']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['isFavorited'] == 1 ? "Favorited" : "Not Favorited"; ?></td>
                            </tr>
                        <?php $key++;
                        } ?>
                    </tbody>
                </table>
                <!-- <div class="card-footer">
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item <?php echo $page == 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="index.php?f=main&file=main&page=<?php echo $page - 1; ?>">Previous</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                    <a class="page-link" href="index.php?f=main&file=main&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo $page == $totalPage ? 'disabled' : ''; ?>">
                                <a class="page-link" href="index.php?f=main&file=main&page=<?php echo $page + 1; ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div> -->
            </div>
        </div>
        <!-- /.card -->
        <!-- </div> -->
        <!-- /.col-md-6 -->
        <!-- </div>
    /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->