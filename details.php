<?php
include('config/db_connection.php');
if(isset($_POST['delete'])){
    $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $sql="DELETE FROM pizza where id=$id_to_delete";
    if(mysqli_query($conn,$sql)){
        header('Location:index.php');

    }else{
        echo "query error:".mysqli_error($conn);
    }
}
if(isset($_GET["id"])){
    $id=mysqli_real_escape_string($conn,$_GET["id"]);
    $sql="SELECT *FROM pizza where id=$id";
    $result=mysqli_query($conn, $sql);
    $pizza=mysqli_fetch_assoc( $result);
    mysqli_free_result($result);
    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">

<body>
<?php include('template/header.php'); ?>
<div class="container center">
    <?php if($pizza): ?>
        <h4><?php echo htmlspecialchars($pizza['name']) ; ?></h4>
        <p>created by:<?php echo htmlspecialchars($pizza['email']) ; ?></p>
        <p><?php echo date($pizza['created_at']) ; ?></p>
        <h6>ingredients:</h6>
        <p><?php echo htmlspecialchars($pizza['ingredients']) ; ?></p>
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand  0-depth-0">
        </form>
    <?php else: ?>
        <h4>no pizza to display</h4>
    <?php endif ;?>

</div>

<?php include('template/footer.php'); ?>

</html>