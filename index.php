

<?php
include('config/db_connection.php');
$sql='SELECT * FROM pizza ORDER BY name';
$result=mysqli_query($conn,$sql);
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
// print_r($pizzas);



?>


<!DOCTYPE html>
<html lang="en">

<?php include('template/header.php'); ?>
<h4 class="center grey-text">Pizzas!</h4>

<div class="container">
    <div class="row">

        <?php foreach($pizzas as $pizza){ ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="img/pizza.svg" alt="pizza" class="pizza">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza['name']); ?></h6>
                        <ul class="grey-text">
                            <?php foreach(explode(',', $pizza['ingredients']) as $ing){ ?>
                                <li><?php echo htmlspecialchars($ing); ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $pizza['id']; ?>" >more info</a>
                    </div>
                </div>
            </div>

        <?php } ?>

    </div>
</div>



<?php include('template/footer.php'); ?>

    

</html>