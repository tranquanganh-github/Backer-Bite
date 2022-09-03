<?php
    $limit = 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($page == 1){
        $key = 0;
    }else{
        $key = ($page - 1) * $limit;
    }
    $offset = ($page - 1) * $limit;
    $statement_all_items = $conn->prepare("SELECT * FROM products"); 
    $statement_all_items->execute();
    $count_all_items = $statement_all_items->rowCount();
    $totalPage = ceil($count_all_items / $limit);
    $statement = $conn->prepare('SELECT * FROM products LIMIT :offset, :limit');
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->execute();
    $all_items = $statement->fetchAll();
?>
<hr>
    <h1 class="my-3 mx-3"> 
        <i class="fa fa-shopping-cart" aria-hidden="true"></i> PRODUCTS LIST
    </h1>
<hr>
<div>
</div>
<a href="index.php?f=products&file=create" class="nav-link col-2 btn-primary my-2 rounded text-center">
    <i class="fa fa-plus mx-2" aria-hidden="true"></i> Create New Product
</a>

<table class="table text-center table-bordered" cellspaccing='0' cellpadding='10'>
    <thead>
        <tr>
            <th>STT</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>COUNT</th>
            <th>PRICE</th>
            <th>STATUS</th>
            <th>FAVORTIED</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_items as $row) { ?>
            <tr>
                <td><?php echo $key?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['count']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['status'] == 1 ? "Enabled" : "Disabled";?></td>
                <td><?php echo $row['isFavorited'] == 1 ? "Favorited" : "Not Favorited";?></td>                
                <td >
                    <a href="index.php?f=products&file=edit&id=<?php echo $row['id'];?>" class="btn btn-sm btn-primary" title="Edit">
                        <i class="fa fa-edit"aria-hidden="true"></i></a>
                    <a href="index.php?f=products&file=delete&id=<?php echo $row['id'];?>" class="btn btn-sm btn-danger mx-2" title="Delete" 
                        onclick="return confirm('Delete this?');">
                        <i class="fa fa-trash"aria-hidden="true"></i></a>
                </td>
            </tr>
        <?php $key++; }?>
        
    </tbody>
</table>
<div class="card-footer">
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
        <li class="page-item <?php echo $page == 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="index.php?f=products&file=main&page=<?php echo $page - 1; ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?f=products&file=main&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?php echo $page == $totalPage ? 'disabled' : ''; ?>">
                <a class="page-link" href="index.php?f=products&file=main&page=<?php echo $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>