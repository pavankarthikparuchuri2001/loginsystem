<?php
    if (isset($_POST["reset-password-submit"])) {
        # code...
        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["pwd"];
        $passwordRepeat = $_POST["pwd-repeat"];

        if (empty($password) || empty($passwordRepeat)) {
            # code...
            # echo 'Hello';
            header("location: ../create-new-password.php?newpwd=empty");
            exit();
        }else if ($password != $passwordRepeat){
            header("location: ../create-new-password.php?newpwd=pwdnotsame");
            exit();
        }

        $currentDate = date("U");

        require '../partials/_dbconnect.php';

        $sql = "select * from pwdReset where pwdResetSelector=? and pwdResetExpires >= ?";
        $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt,$sql)) {
         # code...
         echo "There was an error!";
         exit();
     }else{
         mysqli_stmt_bind_param($stmt, "ss", $selector,$currentDate);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         if (!$row = mysqli_fetch_assoc($result)) {
             # code...
             echo "You need to re-submit your reset request";
             exit();
         }else{
             $tokenBin = hex2bin($validator);
             $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

             if($tokenCheck == false){
                  # code...
                  echo "You need to re-submit your reset request";
                  exit();
             } elseif($tokenCheck == true){
                $tokenEmail = $row['pwdResetEmail'];

                $sql = "select * from users where email = ?;";
                $stmt = mysqli_stmt_init($conn);
             if (!mysqli_stmt_prepare($stmt,$sql)) {
                 # code...
                 echo "There was an error!";
                 exit();
             }else{
                 mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);
                 if (!$row = mysqli_fetch_assoc($result)) {
                     # code...
                     echo "There was an error!";
                     exit();
                 }else{
                     $sql = "UPDATE users set password =? where email =?";
                     $stmt = mysqli_stmt_init($conn);
                     if (!mysqli_stmt_prepare($stmt,$sql)) {
                         # code...
                         echo "There was an error!";
                         exit();
                     }else{

                         $newpwdHash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                         mysqli_stmt_bind_param($stmt,"ss",$newpwdHash,$tokenEmail);
                         echo $sql;
                         mysqli_stmt_execute($stmt);


                         $sql = "Delete from pwdReset where pwdResetEmail=?";
                         $stmt = mysqli_stmt_init($conn);
                         //if(!mysqli_stmt_init($conn));
                         if (!mysqli_stmt_prepare($stmt,$sql)){
                             echo "There was an error!";
                             exit();
                         }else{
                             mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                             mysqli_stmt_execute($stmt);
                             header("location: ../login.php?newpwd=passwordupdated");
                             
                         }

                          



                     }

                 }

             }

             }

         }
     }


    }else{
        header("location: ../login.php");
    
    }

?>