<?php
require_once 'ooplr/core/init.php';

$user = DB::getInstance()->query("SELECT * FROM users");

if(!$user->count()){
	echo 'no user';
} else {
	foreach($user->results() as $user){
		echo $user->username,'<br>';
	}
}