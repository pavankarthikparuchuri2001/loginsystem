<?php 
include('partials/_dbconnect.php');
session_start();
$message = $link = '';
if(isset($_POST['submit'])) {
	$email = $_POST['email'];
	$query = "SELECT * FROM users WHERE email = '".$email."'";
	$result = $conn->query($query);
    if($result->num_rows > 0){
            $row = mysqli_fetch_array($query);
            $username = $row['username'];
            $subject = "Password Reset";
            $body = "Hi".$username."Click here to change your password http://localhost/loginsystem/reset_password.php?username = $username ";
            $sender = "From: pavankarthikparichuri2001@gmail.com";
            if($mail($email, $subject, $body, $sender)){
                $_SESSION['msg'] = "Check your mail to change your password $email";
                header('location:login.php');
            }
            else{
                echo 'Email sending Failed...';
            }
	}
	}else{
		$message = "<div class='alert alert-danger'>Invalid Email..!!</div>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>forget Password</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body  class="bg-secondary">
		<div class="container w-50 mt-5">
			<form class="bg-light p-5 shadow-lg" method="post">
				<?php echo $message; ?>
				<h1 class="text-success">Forget Password</h1>
				<label for="Email">Email</label>
				<input type="email" name="email" placeholder="Email Address" class="form-control form-control-sm" required><br>
				<button type="submit" name="submit" class="btn btn-success btn-sm">Send Mail</button>
				
			</form>
		</div>
</body>
</html>