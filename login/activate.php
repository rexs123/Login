<?php
require($_SERVER['DOCUMENT_ROOT']."/assets/includes/include.php");

//collect values from the url
$id = trim($_GET['x']);
$active = trim($_GET['y']);

//if id is number and the active token is not empty carry on
if(is_numeric($id) && !empty($active)){

	//update users record set the active column to Yes where the id and active value match the ones provided in the array
	$stmt = $conn->prepare("UPDATE users SET active = 'Yes' WHERE id = ? AND active = ?");
	$stmt->bind_param("ii", $id, $active); //id is number active is boolean
	$stmt->execute();
	//if the row was updated redirect the user
	if($stmt->affected_rows == 1){
		//redirect to login page
		header('Location: index.php?action=active');
		exit;

	} else {
		echo "Your account could not be activated.";
	}
	$stmt->close();
	$conn->close();
}
?>
