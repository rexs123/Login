<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
		<a class="navbar-brand" href="/"><?php $sql = "SELECT * FROM settings"; $result = mysqli_query($conn, $sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {  echo $row['brand']; }}?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
				<?
				echo'<li><a href="/">Home</a></li>';
				$sql = "SELECT * FROM navbar";
					$result = mysqli_query($conn, $sql);
						if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo '<li><a href="' . $row['link'] . '">' . $row['title'] . '</a></li>';
					}
				}
				?>
      </ul>
        <ul class="nav navbar-nav navbar-right">
				<?
				$sql = "SELECT * FROM navbar_right";
					$result = mysqli_query($conn, $sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo '<li><a href="' . $row['link'] . '">' . $row['title'] . '</a></li>',"\r\n";
						}
				}
				if(!$user->is_logged_in()){
					echo'<a type="button" class="btn btn-warning navbar-btn" href="/login">Login</a>';
					}else{
						?>
					<div class="btn-group navbar-btn">
					  <button type="button" class="btn btn-primary">My Account</button>
					  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-caret-down"></i>
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
									<li><a href="/users/user.php?=<?php echo $s_user;?>"><i class="fa fa-user fa-fw"></i>&nbsp;My Profile</a></li>
									<li><a href="/user/?id=<?php echo $id;?>"><i class="fa fa-pencil fa-fw"></i>&nbsp;Edit My Profile</a></li>
							<?php if($isadmin =='true'){echo'
									<li class="divider"></li>
									<li><a href="/admin"><i class="fa fa-tasks fa-fw"></i>&nbsp;Admin Menu</a></li>'; }?>
									<li class="divider"></li>
									<li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout</a></li>
					  </ul>
					</div>					
					<?php }?>
        </ul>
    </div>
  </div>
</nav>
<br /><br /><br />