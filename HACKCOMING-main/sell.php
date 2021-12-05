<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include 'partials/_dbconnect.php';        
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        //$exists = false;

        //check whether username exists
        $existsSql = "SELECT * FROM `buyer_signup` WHERE username = 'April';"
        $result = mysqli_query ($conn, $existsSql); 
        $numExistRows = mysqli_num_rows($result);
        
        if($numExistRows > 0)
        {
                $exists = true;
        }
        else 
        {
                $exists = false;
        }
        
        if(($password == $cpassword) &&  $exists==false)
        {
            $sql = "INSERT INTO `buyer_signup` (`username`, `password`, `Date`) VALUES ('$username', '$password', current_timestamp())";
            $result = mysqli_query ($conn, $sql);

            if($result)
            {
                $showAlert = true;
            }
        }

        else
            {
                $showError = "Product Empty";
            }
    }
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Buyer Signup</title>
  </head>
  <body>
    <?php require 'partials/_nav.php'?>
        <?php
            if($showAlert)
            {
            echo ' 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Product Has been Added.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }

            if($showError)
            {
            echo ' 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong>'. $showError.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
            
        ?>

    <div class="container" >
        <h1 class = "text-center" style="margin:5%;">Product Details </h1>
        
        <form action = "product.php" method = "post" style = 
        "
        display: flex;
        flex-direction: column;
        align-items:center;
        ">
            <div class="form-group col-md-6">
                <label for="product">Product</label>
                <input type="text" class="form-control" id="product" name = "product" aria-describedby="emailHelp" placeholder="What's the Product">
            </div>
            
            <!-- Example single danger button -->
            
            <div class="btn-group">
            <p style="position:relative; left:-37.5%;">Product Condition</p> 
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Product Condition
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Excellent</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Good</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Slightly Used</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Used</a>
            </div>
            </div>

            <div class="form-group col-md-6">
                <label for="course">Course</label>
                <input type="course" class="form-control" id="course" name = "course" placeholder="Course">
            </div>

            <div class="form-group col-md-6">
                <label for="price">Price</label>
                <input type="price" class="form-control" id="price" name = "price" placeholder="Price">
            </div>

            <div class="form-group col-md-6">
                <label for="contact">Contact</label>
                <input type="contact" class="form-control" id="contact" name = "contact" placeholder="Please Enter Email">
            </div>
            
            
            <button type="submit" class="btn btn-primary col-md-6"> Submit </button>

        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>