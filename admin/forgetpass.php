<?php 
	include $_SERVER['DOCUMENT_ROOT']."/blog/lib/Session.php";
	Session::checklogin();
 ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/config/config.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/lib/Database.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/helpers/Format.php";?>
<?php 
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $fm->validation($_POST['email']);
	$email = mysqli_real_escape_string($db->link,$email);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email address!";
		}else{
		$mailquery = "select * from tbl_user where email = '$email' limit 1 ";
        $mailcheck = $db->select($mailquery);

		if ($mailcheck != false) {
			while ($value = $mailcheck->fetch_assoc()) {
				$userid = $value['id'];
				$username = $value['name'];
			}
		$text = substr($email, 0, 3);
		$rand = rand(1000, 9999);
		$newpass = "$text$rand";
		$Password = md5($newpass);
		$updatequery = "update tbl_user
                    set 
                    password='$Password'
                    where id = '$userid'";
        $updated_row = $db->update($updatequery);
        $to = $email;
        $from = "plumeria@gmail.com";
        $header = "From: $from\n";
        $header .= "MIME-Version: 1.0 \r\n";
    	$header .= "Content-Transfer-Encoding: 8bit \r\n";
    	$subject = "Your password";
    	$message = "your user name is".$username." and password is ".$Password."please visit website to login";
        $sendmail = mail($to, $subject, $message, $header);
        if ($sendmail) {
        	echo "<span style= 'color:green;font-size:18px;'>please check your email for new password!!</span>";
        }else{
        	echo "<span style= 'color:red;font-size:18px;'>Email not sent!!</span>";
        }

		}else{
			echo "<span style= 'color:red;font-size:18px;'>Email not exist!!</span>";
		}
	}
}?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="email" placeholder="Enter valid email address" required="" name="email"/>
			</div> 
			<div>
				<input type="submit" value="Send Email" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login !</a>
		</div>
		<div class="button">
			<a href="#">Plumeria Yellow</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>