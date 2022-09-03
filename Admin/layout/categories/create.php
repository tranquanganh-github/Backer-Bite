<div class="card text-left mt-5">
    <div class="card-header">
        <h4 class="card-title">Add New Category</h4>
    </div>
    <div class="card-body">
        <?php
        $erors = [];        
        if (isset($_POST['save'])) {
            $name = htmlspecialchars($_POST['categoriesName']);
            $description = htmlspecialchars($_POST['description']);
            if (empty($name) || empty($description)) {
                $errors['categoriesName'] = 'Category Name is required';
                $errors['description'] = 'Description is required';
            }else{               
                $sql = "INSERT INTO categories(categoriesName,description) VALUES (:name,:description)";
                $statement = $conn->prepare($sql);
                $statement->bindParam(':name', $name);
                $statement->bindParam(':description', $description);
                echo "x1111";
                if ($statement->execute()) {
                    echo "haha";
                    header('location: index.php?f=categories&file=main');
                } else {
                    echo mysqli_error($conn);
                }
            }
        }
        ?>
        <form action="" method="POST" role="form">
            <div class="form-group">
                <label for="">Category Name</label>
                <input type="text" class="form-control" name="categoriesName" placeholder="Category Name">
                <?php if (isset($errors['categoriesName'])) : ?>
                    <small class="help-block"><?php echo $erors['categoriesName']; ?></small>
                <?php endif; ?>
                <label for="">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Description">
                <?php if (isset($errors['description'])) : ?>
                    <small class="help-block"><?php echo $erors['description']; ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="save"><i class="fas fa-save" ></i> Save</button>
            <a href="index.php?f=categories&file=main" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Cancel</a>
        </form>
    </div>
</div>