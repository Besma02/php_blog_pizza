<?php
include('config/db_connection.php');
$email=$name=$ingredients='';
$errors=array('email'=>'','name'=>'','ingredients'=>'');
if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
        $errors['email']='email is required';
    }else{
        $email=$_POST['email'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email']= 'email must be a valid adress';
        };
    };
    if(empty($_POST['name'])){
        $errors['name']= 'name is required';
        }
        else{
            $name=$_POST['name'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$name)){
                $errors['name']='name must contain letters spaces';
            };
        };   
    
    if(empty($_POST['ingredients'])){
        $errors['ingredients']='ingredients required';
    }else{
        $ingredients=$_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
        $errors['ingredients']='ingredients must be separed with comas';
    };
    };

    if(array_filter($errors)){
        echo 'form has errors';
    }else{
        echo 'form is valid';
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);
        $sql="INSERT INTO pizza (email,name,ingredients)VALUES('$email','$name','$ingredients')";
        if(mysqli_query($conn,$sql)){
            header('Location: index.php');
        }else{
            echo"query error:".mysqli_error($conn);
        }
       
    };
};
      
   



?>


<!DOCTYPE html>
<html lang="en">
<?php   include('template/header.php') ?>
 <section class="container">
    <form action="add.php" class="white" method="POST">
        <label for="email">email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
        <div class="red-text"><?php echo $errors['email'];  ?></div>
        <label for="name">name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name)?>">
        <div class="red-text"><?php echo $errors['name'];  ?></div>
        <label for="ingredients">ingredients</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
        <div class="red-text"><?php echo $errors['ingredients'];  ?></div>
        <div class="center">
            <input type="submit" name="submit" class="btn brand">
        </div>
    </form>
 </section>



<?php   include('template/footer.php') ?>
    
</body>
</html>