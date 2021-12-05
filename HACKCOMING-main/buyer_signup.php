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

        $existsSql = "SELECT * FROM `buyer_signup` WHERE username = '$username'";
        $result = mysqli_query ($conn, $existsSql); 
        $numExistRows = mysqli_num_rows($result);
        
        if($numExistRows > 0)
        {
                //$exists = true;
                $showError = "Username already Exists";
        }
        else 
        {
           // $exists = false;
        
            if(($password == $cpassword))
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
                $showError = "Passwords do not match";
            }
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
                <strong>Success!</strong> Your Account is now created. Proceed to Login Page.
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
        <h1 class = "text-center" style="margin:5%;">Sign Up here</h1>
        
        <form action = "buyer_signup.php" method = "post" style = 
        "
        display: flex;
        flex-direction: column;
        align-items:center;
        ">
            <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name = "username" aria-describedby="emailHelp" placeholder="Username">
            </div>

            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
            </div>

            <div class="form-group col-md-6">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name = "cpassword" placeholder="Confirm Password">
                <small id="passwordhelp" class="form-text text-muted">Make sure that the password match.</small>
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