<?php
		//connect to server and select database
//$mysqli = mysqli_connect("localhost","root","","subscription") or die (mysql_error());
$mysqli = mysqli_connect("localhost", "lisabalbach_voss18", "CIT180137", "lisabalbach_voss18");
if (!$_POST) {
	//they need to see the form, so create form block
	$display_block = <<<END_OF_BLOCK
	<form method="POST" action="$_SERVER[PHP_SELF]">

	<p><label for="email">Your Email Address:</label><br/>
	<input type="email" id="email" name="email" size="40" maxlength="150" /></p>

	<p><label for="firstName">First Name:</label><br/>
	<input type="firstName" id="firstName" name="firstName" size="40" maxlength="50" /></p>

	<p><label for="lastName">Last Name:</label><br/>
	<input type="lastName" id="lastName" name="lastName" size="40" maxlength="50" /></p>

    <p><label for="username">Username:</label><br/>
    <input type="username" id="username" name="username" size="40" maxlength="25" /></p>

    <p><label for="password">Password:</label><br/>
	<input type="password" id="password" name="password" size="40" maxlength="41" /></p>

	</fieldset>

	<button type="submit" class="btn-dark" name="submit" value="submit">Submit</button>
	<p style='text-align:center;font-size:2em;'><a href='mySubscriptionMenu.html'> Return to login</p>;
	</form>
END_OF_BLOCK;

} else if (($_POST)) {
	//trying to authorize; validate email address
	if ($_POST['email'] == "") {
		header("Location: addUser.php");
		exit;
	} else {function emailChecker($email) {
		global $mysqli, $safe_email, $check_res;
	
		//check that email is not already in list
		$safe_email = mysqli_real_escape_string($mysqli, $email);
		$check_sql = "SELECT id FROM auth_users WHERE email = '".$safe_email."'";
		$check_res = mysqli_query($mysqli, $check_sql) or die(mysqli_error($mysqli));
	}

				//get number of results and do action
				
				emailChecker($_POST['email']);

				//get number of results and do action
				if (mysqli_num_rows($check_res) < 5) {
					//free result
					mysqli_free_result($check_res);
	
		
			//create clean versions of input strings
			//$safe_ID = mysqli_real_escape_string($mysqli, $_POST['id']);
			$safe_FirstName = mysqli_real_escape_string($mysqli, $_POST['firstName']);
			$safe_LastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);
			$safe_email = mysqli_real_escape_string($mysqli, $_POST['email']);
            $safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
			$safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);
		
			
			//add record
			if ($_POST['email']) {
				//something relevant, so add to participant table
				$add_person_sql = "INSERT INTO auth_users ( firstName, lastName, email, username, password) 
				 VALUES ( '".$safe_FirstName."', '".$safe_LastName."','".$safe_email."','".$safe_username."','".$safe_password."' )";
				$add_person_res = mysqli_query($mysqli, $add_person_sql) or die(mysqli_error($mysqli));
			}
		
			
			$display_block = "<h1>Record(s) Added</h1><p>Would you like to
			<a href=\"".$_SERVER['PHP_SELF']."\">Add another</a>?...Return to the <a href='authentication.html'>main menu</a>?</p>";

			//close connection to MySQL
			mysqli_close($mysqli);
				}
		else {
			//print failure message
			$display_block = "<p>You already have a log in!</p>";
			mysqli_close($mysqli);
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Add User Authentication</title>
<link href="MunsonFitnessClub.css" type="text/css" rel="stylesheet" />
</head>
<div>
    <?php 
    echo $display_block;
    ?>
</div>
</body>
</html>
