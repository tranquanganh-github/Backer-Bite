<?php
$id = $_GET['id'];
$sql_select_products = "SELECT * FROM products WHERE id = $id";
$row_product = $conn->query($sql_select_products)->fetch(PDO::FETCH_ASSOC);

$sql_select_category = "SELECT * FROM categories ";
$all_items = $conn->query($sql_select_category)->fetchAll();
?>
<div class="card text-left mt-5">
    <div class="card-header">
        <h4 class="card-title">Edit Product</h4>
    </div>
    <div class="card-body">
        <?php
        $generated_file_name = "";
        $errors = [];
        if (isset($_POST['save'])) {
            $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];
            $imageName = $_FILES['image']['name'];
            if (!empty($imageName)) {
                $file_size = $_FILES['image']['size'];
                $file_tmp_name = $_FILES['image']['tmp_name'];
                $generated_file_name = time() . '-' . $imageName;
                $destination_path = "./images/products/${generated_file_name}";
                $file_extension = explode('.', $imageName);
                $file_extension = strtolower(end($file_extension));
                if (in_array($file_extension, $permitted_extensions)) {
                    if ($file_size <= 2000000) {
                        move_uploaded_file($file_tmp_name, $destination_path);
                    } else {
                        $errors['image'] = 'File is too big';
                    }
                } else {
                    $errors['image'] = 'Invalid file type';
                }
            }

            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $count = htmlspecialchars($_POST['count']);
            $price = intval(htmlspecialchars($_POST['price'])) ?? 0;
            $status = $_POST['status'];
            $isFavorited = intval($_POST['isFavorited']);
            $categoriesId = ($_POST['categoriesId']);
            $updateDate = date('Y-m-d H:i:s');

            if (empty($name)) {
                $errors['name'] = 'Name product is required';
            }
            if ($count == '') {
                $errors['count'] = 'Count product is required';
            } else if (!is_numeric($count)) {
                $errors['count'] = 'Count product is number';
            } else if ($count < 0) {
                $errors['count'] = 'Count product is greater than 0';
            }
            if ($price == '') {
                $errors['price'] = 'Price product is required';
            } else if (!is_numeric($price)) {
                $errors['price'] = 'Price product is number';
            } else if ($price < 0) {
                $errors['price'] = 'Price product is greater than 0';
            }
            if (count($errors) == 0) {
                try {
                    $sql = 'UPDATE products SET 
                                name = :name, 
                                description = :description, 
                                url = :url,
                                count = :count, 
                                price = :price, 
                                status = :status, 
                                isFavorited = :isFavorited, 
                                categoriesId = :categoriesId, 
                                updateDate = :updateDate 
                            WHERE id = :productId;
                    ';
                    $statement = $conn->prepare($sql);
                    $statement->bindParam(':name', $name);
                    $statement->bindParam(':description', $description);
                    $generated_file_name = $generated_file_name == "" ? $row_product['url'] : $generated_file_name;
                    $statement->bindParam(':url', $generated_file_name);
                    $statement->bindParam(':count', $count);
                    $statement->bindParam(':price', $price);
                    $statement->bindParam(':status', $status);
                    $statement->bindParam(':isFavorited', $isFavorited);
                    $statement->bindParam(':categoriesId', $categoriesId);
                    $statement->bindParam(':updateDate', $updateDate);
                    $statement->bindParam(':productId', $id);
                    if ($statement->execute()) {
                        header('location: index.php?f=products&file=main');
                    } else {
                        header('location: index.php?f=main&file=404');
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row_product['name']; ?>">
                        <?php if (isset($erors['name'])) : ?>
                            <small class="help-block"><?php echo $erors['name']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control description">
                            <?php echo $row_product['description']; ?>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="save"><i class="fas fa-save"></i> Save</button>
                    <a href="index.php?f=product&file=main" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Cancel</a>
        </form>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Select Category</label>
            <select name="categoriesId" id="input" class="form-control" value="<?php echo $row_product['categoriesId']; ?>">
                <?php foreach ($all_items as $row_categories) { ?>
                    <option value="<?php echo $row_categories['categoriesID']; ?>"><?php echo $row_categories['categoriesName']; ?></option>
                <?php } ?>
            </select>
            </label>
        </div>
        <div class="form-group">
            <label for="">Count</label>
            <input type="text" class="form-control" name="count" value="<?php echo $row_product['count']; ?>">
            <?php if (isset($erors['count'])) : ?>
                <small class="help-block"><?php echo $erors['count']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="text" class="form-control" name="price" value="<?php echo $row_product['price']; ?>">
            <?php if (isset($erors['price'])) : ?>
                <small class="help-block"><?php echo $erors['price']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="">Select Status</label>
            <select name="status" id="input" class="form-control" value="<?php echo $row_product['status']; ?>">
                <option value="0">Disable</option>
                <option value="1">Enable</option>
                <?php if (isset($erors['status'])) : ?>
                    <small class="help-block"><?php echo $erors['status']; ?></small>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Select Favortied</label>
            <select name="isFavorited" id="input" class="form-control" value="<?php echo $row_product['isFavorited']; ?>">
                <option value="0">Not Favorited</option>
                <option value="1">Favorited</option>
                <?php if (isset($erors['isFavorited'])) : ?>
                    <small class="help-block"><?php echo $erors['isFavorited']; ?></small>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" name="image">
            <?php if (isset($erors['image'])) : ?>
                <small class="help-block"><?php echo $erors['image']; ?></small>
            <?php endif; ?>
        </div>
    </div>
</div>