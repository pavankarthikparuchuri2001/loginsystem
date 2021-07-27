<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <?php include 'partials/_nav.php' ?>
  <?php
    //   if($login){
    //   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //   <strong>Success!</strong> You are logged in.
    // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    //   }
    //   if($showError){
    //     echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    //         <strong>Error!</strong> '. $showError.'
    //     </div> ';
    //     }

    //     if($message){
    //       echo'<div class="alert alert-info" role="alert">'.$message.'
    //       </div>';
    //       }
    ?>
  <title>Login</title>
</head>
<body>
  <!-- <div class="navbar"></div> -->
  <div class="container">
  <div class="wrapper">
    <section class="form login">
      <?php
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];


            if (empty($selector) || empty( $validator)) {
                # code...
                echo "could not validate your request";
            }else{
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                    # code...
                    ?>
                    
                    <form action="includes/reset-password.inc.php" method="post">
                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                        <input type="password" name="pwd" placeholder="Enter your password">
                        <input type="password" name="pwd-repeat" placeholder="Confirm password">
                        <button type="submit" name="reset-password-submit">Reset Password</button>

                    </form>
                    <?php
                }
            }
          ?>
      
    </section>
  </div>
</div>
<script src="javascript/pass-show-hide.js"></script>


</script>
  

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