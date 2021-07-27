<?php

if (isset($_POST["reset-request-submit"])) {
    # code...
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/loginsystem/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);
    
    $expires = date("U") + 1800;
    require '../partials/_dbconnect.php';

    $userEmail = $_POST["email"];

     $sql = "delete from pwdReset where pwdResetEmail= ?";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt,$sql)) {
         # code...
         echo "There was an error!";
         exit();
     }else{
         mysqli_stmt_bind_param($stmt, "s", $userEmail);
         mysqli_stmt_execute($stmt);
     }

     $sql = "Insert into pwdReset(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) values (?,?,?,?);";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt,$sql)) {
         # code...
         echo "There was an error!";
         exit();
     }else{
         $hashedToken = password_hash($token, PASSWORD_DEFAULT);
         mysqli_stmt_bind_param($stmt, "ssss", $userEmail,$selector,$hashedToken,$expires);
         mysqli_stmt_execute($stmt);
     }
     mysqli_stmt_close($stmt);
     mysqli_close($conn);

     $to = $userEmail;
     $subject = 'Reset Your Password';
     $message = '<p> We recieved a password reset request.The link is to reset your password</p>';
     $message .= '<p>Here is your password reset link:<br>';
     $message .= '<a href='. $url .'>'.$url.'</a></p>';

     $headers = "From: pavankarthikparichuri2001@gmail.com\r\n";
     $headers .= "Reply-To: sriramiitphysics@gmail.com\r\n";
     $headers .= "Content-type: text/html\r\n";
     mail($to, $subject, $message, $headers);

     header("Location: ../reset-password.php?reset = success");


     

}else{
    header("location: ../login.php");

}