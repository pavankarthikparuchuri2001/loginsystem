<?php
$message  = false;
$showAlert =  false;
$showError = false;
$errors = array();
 if(!empty($_POST['g-recaptcha-response']))
 {
       $secret = '6LeXviMbAAAAAGAfGB2_zRB9Kl_viBLxG1MIcqnr';
       $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
       $responseData = json_decode($verifyResponse);
       if($responseData->success){
       if($_SERVER["REQUEST_METHOD"] == "POST"){
         include 'partials/_dbconnect.php'; 
         $fname = $_POST["fname"];
         $lname = $_POST["lname"];
         $user = $_POST["username"];
         $email = $_POST["email"];
         $password = $_POST["password"];
         $email_check = "select * from users where email = '$email' ";
         $res = mysqli_query($conn, $email_check);
         $exist = false;
         if($exist ==  false){
           $hash = password_hash($password, PASSWORD_DEFAULT);
           $sql = "INSERT INTO `users` (`fname`, `lname`, `username`, `email`, `password`) VALUES ('$fname', '$lname', '$user', '$email', '$hash')";
           $result = mysqli_query($conn,$sql);
           if($result){
             $showAlert = true;
       
           }
           else{
            $showError = "Try again";
          }
         }
         else{
           $showError = true;
           $showError = "Username already exists";
         }
       
       }
       }
      else{
           $message = "Some error in verifying g-recaptcha";
      }
  }
?> 

<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php include 'partials/_nav.php' ?>
    <?php
      if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your account is sucessfully created now you can login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      }
      if($showError){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'

        </div> ';
        }
        if($message){
          echo'<div class="alert alert-info" role="alert">'.$message.'
          </div>';
          }
    ?>
    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>


    <title>Signup</title>
  </head>
  <body>
    <!-- <div class="navbar"></div> -->
    <div class="container">
    <div class="wrapper">
    <section class="form signup">
      <header>Signup Page</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Username</label>
          <input type="text" name="username" placeholder="enter your username" required>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
 
        <!-- <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
        </div> -->
        
        <div class="g-recaptcha" data-sitekey="6LeXviMbAAAAAHSxmg8apWbX4iPrZV9kDMF5lU6R" required></div>
        <div class="field button">
          <input type="submit" name="submit" value="signup">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>
</div>
  <script src="javascript/pass-show-hide.js"></script>
  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdeli  vr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    
  </body>
</html>