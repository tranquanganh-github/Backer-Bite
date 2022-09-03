<?php
// $queryCats = mysqli_query($conn, "SELECT categoriesId,categoriesName FROM categories Order by categoriesName ASC");
    $statement = $conn->prepare('SELECT categoriesID, categoriesName FROM categories ORDER BY categoriesName ASC');
    $statement->execute();
    $all_items = $statement->fetchAll();        
?>
<div class="card text-left mt-5">
    <div class="card-header">
        <h2 class="card-title">Add New Product</h2>
    </div>
    <div class="card-body">
        <?php
        $errors = array();
        if (isset($_POST['save'])) {
            $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];        
            $imageName = $_FILES['image']['name'];
            if(!empty($imageName)) {
                $file_size = $_FILES['image']['size'];
                $file_tmp_name = $_FILES['image']['tmp_name'];  
                $generated_file_name = time() . '-' . $imageName;         
                $destination_path = "./images/products/${generated_file_name}";
                $file_extension = explode('.', $imageName);
                $file_extension = strtolower(end($file_extension));   
                if(in_array($file_extension, $permitted_extensions)) {
                    if($file_size <= 2097152) {
                        move_uploaded_file($file_tmp_name, $destination_path);                        
                    } else {
                        $errors['image'] = 'File is too big';                    
                    }
                } else {
                    $errors['image'] = 'Invalid file type';
                }
            } else {
                $errors['image'] = 'No file selected, please try again';
            }
    
            $name = htmlspecialchars($_POST['name']);
            $description = $_POST['description'];
            $count = htmlspecialchars($_POST['count']);
            $price = intval(htmlspecialchars($_POST['price'])) ?? 0;
            $status = $_POST['status'];
            $isFavorited = $_POST['isFavorited'];
            $categoriesID = htmlspecialchars($_POST['categoriesID']);

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
                    $sql = 'INSERT INTO products
                            (name, description, url, count, price, status, 
                                isFavorited, categoriesId) 
                            VALUES (:name, :description, :url, :count, :price, :status, 
                                :isFavorited, :categoriesId)
                    ';
                    $statement = $conn->prepare($sql);
                    $statement->bindParam(':name', $name);
                    $statement->bindParam(':description', $description);
                    $statement->bindParam(':url', $generated_file_name);
                    $statement->bindParam(':count', $count);
                    $statement->bindParam(':price', $price);
                    $statement->bindParam(':status', $status);
                    $statement->bindParam(':isFavorited', $isFavorited);
                    $statement->bindParam(':categoriesId', $categoriesID);
                    if ($statement->execute()) {
                        header('location: index.php?f=products&file=main');
                    } else {
                        header('location: index.php?f=main&file=404');
                    }
                }catch(PDOException $e) {
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
                        <input type="text" class="form-control" name="name">
                        <?php if (isset($errors['name'])) : ?>
                            <small class="help-block"><?php echo $errors['name']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input name="description" class="form-control" type="text"></input>
                    </div>
                    <button type="submit" class="btn btn-primary" name="save"><i class="fas fa-save" ></i> Save</button>
                    <a href="index.php?f=product&file=main" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Cancel</a>
        </form>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Select Category</label>
            <select name="categoriesID" id="input" class="form-control">
                <?php foreach ($all_items as $row){?>
                    <option value="<?php echo $row['categoriesID'];?>"><?php echo $row['categoriesName']; ?></option>
                <?php } ?>
            </select>
            </label>
        </div>
        <div class="form-group">
            <label for="">Count</label>
            <input type="text" class="form-control" name="count">
            <?php if (isset($errors['count'])) : ?>
                <small class="help-block"><?php echo $errors['count']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="text" class="form-control" name="price">
            <?php if (isset($errors['price'])) : ?>
                <small class="help-block"><?php echo $errors['price']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="">Select Status</label>
            <select name="status" id="input" class="form-control">
                <option value="0">Disable</option>
                <option value="1">Enable</option>
                <?php if (isset($errors['status'])) : ?>
                    <small class="help-block"><?php echo $errors['status']; ?></small>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Select Favorited</label>
            <select name="isFavorited" id="input" class="form-control">
                <option value="0">Not Favorited</option>
                <option value="1">Favorited</option>
                <?php if (isset($errors['isFavortied'])) : ?>
                    <small class="help-block"><?php echo $errors['isFavortied']; ?></small>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" name="image">
            <?php if (isset($errors['image'])) : ?>
                    <small class="help-block"><?php echo $errors['image']; ?></small>
            <?php endif; ?>
        </div>
    </div>
</div>
