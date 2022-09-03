<hr>
<?php 
    $id = $_GET['id'];
    $sql = "DELETE FROM categories WHERE categoriesID = $id";
    $statement = $conn->prepare($sql);
    if($statement->execute()){
        header('location: index.php?f=categories&file=main');
    }else{
        header('location: index.php?f=main&file=404');
    }
?>