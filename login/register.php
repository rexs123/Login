<?php
$title = 'Register';
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');

//if logged in redirect to users page
if( $user->is_logged_in() ){ header('Location: http://'. DIR .'/users/?user='. $username); }
$msg='';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$recaptcha=$_POST['g-recaptcha-response'];
	if(!empty($recaptcha)){
		include("getCurlData.php");
		$google_url="https://www.google.com/recaptcha/api/siteverify";
		$ip=$_SERVER['REMOTE_ADDR'];
		$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
		$res=getCurlData($url);
		$res= json_decode($res, true);
		//reCaptcha success check 
		if($res['success']){	
	if(isset($_POST['submit'])){
	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$stmt = $conn->prepare('SELECT username FROM users WHERE username = ?');
		$stmt->bind_param("s", $_POST['username']);
		$stmt->execute();
		$stmt->bind_result($row);

		while ($stmt->fetch()) {
      if(!empty($row)){
				$error[] = 'Username provided is already in use.';
				break; //stop the while loop
			}
    }
		$stmt->close();
	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $conn->prepare('SELECT email FROM users WHERE email = ?');
		$stmt->bind_param("s", $_POST['email']);
		$stmt->execute();
		$stmt->bind_result($row);

		while ($stmt->fetch()) {
			if(!empty($row)){
				$error[] = 'Email provided is already in use.';
				break; //stop the while loop
			}
		}
		$stmt->close();
	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {

			//insert into database with a prepared statement
			$stmt = $conn->prepare('INSERT INTO users (username,password,email,active) VALUES (?, ?, ?, ?)');
			$stmt->bind_param("ssss", $_POST['username'], $hashedpassword, $_POST['email'], $activasion);
			$stmt->execute();
			$stmt->close();
			$id = $conn->insert_id;

			//send email
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = "Thank you for registering at demo site.\n\n To activate your account, please click on this link:\n\n ".DIR."/login/activate.php?x=$id&y=$activasion\n\n Regards Site Admin \n\n";
			$additionalheaders = "From: <".SITEEMAIL.">\r\n";
			$additionalheaders .= "Reply-To: ".SITEEMAIL."";
			mail($to, $subject, $body, $additionalheaders);

			//redirect to index page
			header('Location: index.php?action=joined');
			exit;
		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}
}else{
$msg="Please re-enter your reCAPTCHA.";
}
}else{
$msg="Please re-enter your reCAPTCHA.";
}
}
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="<? echo $_SERVER['PHP_SELF'];?>" autocomplete="off">
				<h2>Please Sign Up</h2>
				<p>Already a member? <a href='index.php'>Login</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<div class="alert alert-danger">'.$error, $msg.'</div>';
						echo $msg;
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<div class='alert alert-success'>Registration successful, please check your email to activate your account.</div>";
				}
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" tabindex = "3" required>
						</div>
					<span class="pwstrength_viewport_verdict"></span>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password" tabindex = "4" required>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
					<div class="col-xs-6 col-md-6"><div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>
