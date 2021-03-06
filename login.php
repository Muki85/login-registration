<?php
require_once 'ooplr/core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))) {
		
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
		));
		
		if($validation->passed()) {
			$user = new User();
			$login = $user->login(Input::get('username'), Input::get('password'));
			
			if($login) {				
				Redirect::to('bo.php');
			} else {
				echo '<html>
                      <head><link rel="stylesheet" type="text/css" href="css/style.css" />
		              <link rel="stylesheet" type="text/css" href="css/animate-custom.css" /></head>
                      <div class="login">
                      <h2 style="color:rgb(61, 157, 179);"><center>Sorry, logging in faild. Try again..</center></h2>
					  </div> 
					  </html>';
				
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
        
        <title>Login</title>
        
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>


<div id="container_demo" >
	<a class="hiddenanchor" id="toregister"></a>
	<a class="hiddenanchor" id="tologin"></a>

	<div id="wrapper">
		<div id="login" class="animate form">
			<form  action="" method="post"> 
				<h1>Log In</h1> 
				<p> 
					<label for="username" class="uname" data-icon="u" > Your username </label>
					<input id="text" name="username" id="username" required="required" type="text" placeholder=""/>
				</p>

				<p> 
					<label for="password" class="youpasswd" data-icon="p"> Your password </label>
					<input id="password" name="password" id="password" required="required" type="password" placeholder="" /> 
				</p>
				
                              
				<p class="login button"> 
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					<input type="submit" value="Login" /> 
				</p>
				<p> 
					If you are not registered, go and <a href="register.php">Register Here..</a> 
				</p>
</form>
</div>
</html>
