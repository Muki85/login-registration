<?php
require_once 'ooplr/core/init.php';

$user = DB::getInstance()->update('users', 3, array(
	'password' => 'newpassword',
	'name' => 'dale garrent'
));

