<?php
session_start();
include('include.php');
include('var.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="author" content="Rexsdev &amp; Design">
<title><?php $sql = "SELECT * FROM settings"; $result = mysqli_query($conn, $sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {  echo $row['title']; }}?> | <?php if(isset($title)){ echo $title; }?></title>
<link href="<?php echo DIR;?>/assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/jquery-ui.css">
<link href="<?php echo DIR;?>/assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
