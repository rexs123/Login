<?php
$title = 'Reset Account';
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
//if logged in redirect to users page
if( $user->is_logged_in() ){ header('Location: index.php'); }
//if form has been submitted process it
if(isset($_POST['submit'])){
	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $conn->prepare('SELECT email FROM users WHERE email = ?');
		$stmt->bind_param("s", $_POST['email']);
		$stmt->execute();
		$stmt->bind_result($row);
		while ($stmt->fetch()) {
			if (!empty($row)) {
				$email = $row;
				break; //stop the while loop
			}
		}
		if (!isset($email)) {
			$error[] = 'No email address has been found';
		}
		$stmt->close();
	}
	//if no errors have been created carry on
	if(!isset($error)){
		//create the activation code
		$token = md5(uniqid(rand(),true));
		$stmt = $conn->prepare("UPDATE users SET resetToken = ?, resetComplete='No' WHERE email = ?");
		$stmt->bind_param("ss", $token, $email);
		$stmt->execute();
		//send email
		$to = $row;
		$subject = "Password Reset";
		$body = "Someone requested that the password be reset. \n\nIf this was a mistake, just ignore this email and nothing will happen.\n\nTo reset your password, visit the following address: ".DIR."/login/resetPassword.php?key=$token";
		$additionalheaders = "From: <".SITEEMAIL.">\r\n";
		$additionalheaders .= "Reply-To: $".SITEEMAIL."";
		mail($to, $subject, $body, $additionalheaders);
		//redirect to index page
		header('Location: index.php?action=reset');
		exit;
	}

}
?>
<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Reset Password</h2>
				<p><a href='login.php'>Back to login page</a></p>
				<hr>
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
					}
				}
				if(isset($_GET['action'])){
					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo '<div class="alert alert-success" role="alert">Your account is now active you may now log in.</div>';
							break;
						case 'reset':
							echo '<div class="alert alert-success" role="alert">Please check your inbox for a reset link.</div>';
							break;
					}
				}
				?>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="" tabindex="1">
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Sent Reset Link" class="btn btn-primary btn-block btn-lg" tabindex="2"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>
