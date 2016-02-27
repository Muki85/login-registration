<?php
require_once 'ooplr/core/init.php';
?>


<html>

<style>
	* {
		padding: 0px;
		margin: 0px;
	}

	body {
		padding: 10px;
	}

	.tab-holder {
		text-align: left;
		border-bottom: 1px solid #000;
		height: 30px;
	}

	.tab {
		position: relative;
		bottom: -1px;
		border: 1px solid #000;
		display: inline-block;
		padding: 5px 20px;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
	}

	.tab.active {
		border-bottom: 1px solid white;
	}

	.content {
		text-align: left;
	}
</style>

<div class="tab-holder">
	<a href="bo.php" class="tab">Home</a>
	<a href="userlist.php" class="tab active ">User list</a>
	<a href="logout.php" class="tab">Logout</a>
</div>
<div class="content">
	<?php
	$user = DB::getInstance()->query("SELECT * FROM users ORDER BY joined ASC");

if(!$user->count()) {
	echo 'No user';
} else {
	foreach($user->results() as $user) {
		echo $user->username, '<br>';
	}
}
	
	?>
</div>
</html>
