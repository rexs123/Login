<?php
include('password.php');
class User extends Password{

    private $_db;

    function __construct($conn){
    	parent::__construct();

    	$this->_db = $conn;
    }

	private function get_user_hash($username){
		$stmt = $this->_db->prepare('SELECT password FROM users WHERE username = ? AND active="Yes" ');
    $stmt->bind_param("s", $username);
		$stmt->execute();
    $stmt->bind_result($row);

    while ($stmt->fetch()) {
      return $row;
    }
	}

	public function login($username,$password){

		$hashed = $this->get_user_hash($username);

		if($this->password_verify($password,$hashed) == 1){

		    $_SESSION['loggedin'] = true;
		    return true;
		}
	}

	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}
}
?>
