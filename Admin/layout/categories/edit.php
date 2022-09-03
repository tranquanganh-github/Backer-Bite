<?php 
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM categories WHERE categoriesID = $id";
    $row = $conn->query($sql_select)->fetch(PDO::FETCH_ASSOC);
?>

<div class="card text-left mt-5">
    <div class="card-header">
        <h4 class="card-title">Edit Category</h4>
    </div>
    <div class="card-body">   
        <?php
        if(isset($_POST['categoriesName'])){
            $categoriesName = $_POST['categoriesName'];
            $description = $_POST['description'];

            $sql = "UPDATE categories SET 
                        categoriesName = :categoriesName , 
                        description = :description 
                    WHERE categoriesID = $id";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':categoriesName', $categoriesName);
            $statement->bindParam(':description', $description);
            if($statement->execute()){
                header('location: index.php?f=categories&file=main');
            }else{
                $error['message'] = 'Error';
            }
        }
        ?>
        <form action="" method="POST" role="form">
        
            <div class="form-group">
                <label for="">Category Name</label>
                <input type="text" class="form-control" name="categoriesName" value="<?php echo $row['categoriesName'];?>">
                <label for="">Description</label>
                <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>">
                <?php if (isset($errors['message'])) : ?>
                    <small class="help-block"><?php echo $erors['message']; ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            <a href="index.php?f=categories&file=main" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Cancel</a>
        </form>
    </div>
</div>