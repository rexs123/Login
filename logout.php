<?php require($_SERVER['DOCUMENT_ROOT']."/assets/includes/include.php");

//logout
$user->logout(); 

//logged in return to index page
header('Location: ./');
exit;
?>