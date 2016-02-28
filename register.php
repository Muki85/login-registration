<?php
require_once 'ooplr/core/init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));
		
		if($validation->passed()){
			$user = new User();
			
			$salt = Hash::salt(32);
			
			try {
				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group1' => 1
					
				));
				echo 'You have registered Successfuly, you can now <a href="login.php">log in</a>';
				echo "<br>";

				Session::flash('home', 'You have been registered and can now log in!');
				
			} catch(Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
?>

<html>
<head>
        
        <title>Register</title>
        
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>


<div id="container_demo" >
	<a class="hiddenanchor" id="toregister"></a>
	<a class="hiddenanchor" id="tologin"></a>

	<div id="wrapper">
		<div id="login" class="animate form">
			<form  action="" method="post"> 
				<h1>Register</h1> 
				<p> 
					<label for="username" class="uname" data-icon="u" > Your username </label>
					<input name="username" id="username" required="required" type="text" />
				</p>

				<p> 
					<label for="password" class="youpasswd" data-icon="p"> Your password </label>
					<input name="password" id="password" required="required" type="password" /> 
				</p>

                                <p> 
					<label for="password" class="youpasswd" data-icon="p"> Enter your password again </label>
					<input name="password_again" id="password_again" required="required" type="password" /> 
				</p>

                                <p> 
					<label for="password" class="youpasswd" data-icon="n"> Name </label>
					<input name="name" value="<?php echo escape(Input::get('name')); ?>" id="name" type="text" /> 
				</p>
				
                              
				<p class="login button"> 
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					<input type="submit" value="Register" /> 
				</p>
</form>
</div>
</html>