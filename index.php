<?php
require_once 'ooplr/core/init.php';

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

