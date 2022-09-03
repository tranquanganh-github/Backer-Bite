<hr>
<?php 
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id);
    if($statement->execute()){
        header('location: index.php?f=products&file=main');
    }else{
        echo "Faile";
    }
?>