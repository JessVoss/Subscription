<?php
include 'Connection.php';

//determine if they need to see the form or not
if (!$_POST) {
	//they need to see the form, so create form block
	$display_block = <<<END_OF_BLOCK
	<form method="POST" action="$_SERVER[PHP_SELF]">

	<p><label for="email">Your Email Address:</label><br/>
	<input type="email" id="email" name="email" size="40" maxlength="50" /></p>

	<p><label for="FirstName">First Name:</label><br/>
	<input type="FirstName" id="FirstName" name="FirstName" size="40" maxlength="30" /></p>

	<p><label for="LastName">Last Name:</label><br/>
	<input type="LastName" id="LastName" name="LastName" size="40" maxlength="30" /></p>

	<p><label for="Phone">Phone:</label><br/>
	<input type="Phone" id="Phone" name="Phone" size="40" maxlength="10" /></p>

	<p><label for="Department">Your Department:</label><br/>
	<input type="Department" id="Department" name="Department" size="40" maxlength="20" /></p>

	</fieldset>

	<button type="submit" class="btn-dark" name="submit" value="submit">Submit</button>
	</form>
END_OF_BLOCK;

} else if (($_POST)) {
	//trying to subscribe; validate email address
	if ($_POST['email'] == "") {
		header("Location: management.php");
		exit;
	} else {
		//connect to database
		doDB();

		//check that email is in list
		emailChecker($_POST['email']);

		//get number of results and do action
		if (mysqli_num_rows($check_res) < 5) {
			//free result
			mysqli_free_result($check_res);
		
			//create clean versions of input strings
			$safe_FirstName = mysqli_real_escape_string($mysqli, $_POST['FirstName']);
			$safe_LastName = mysqli_real_escape_string($mysqli, $_POST['LastName']);
			$safe_Phone = mysqli_real_escape_string($mysqli, $_POST['Phone']);
			$safe_email = mysqli_real_escape_string($mysqli, $_POST['email']);
			$safe_Department = mysqli_real_escape_string($mysqli, $_POST['Department']);
		
			
			//add record
			if ($_POST['email']) {
				//something relevant, so add to participant table
				$add_person_sql = "INSERT INTO participant (FirstName, LastName, Email, Phone, Department) 
				 VALUES ( '".$safe_FirstName."', '".$safe_LastName."','".$safe_email."','".$safe_Phone."','".$safe_Department."' )";
				$add_person_res = mysqli_query($mysqli, $add_person_sql) or die(mysqli_error($mysqli));
			}
		
			$display_block = "<p>Thanks for signing up!</p>";

			//close connection to MySQL
			mysqli_close($mysqli);
		}
		else {
			//print failure message
			$display_block = "<p>You're already subscribed!</p>";
			mysqli_close($mysqli);
		}
	}
} 

include 'BeginNavigation.php';
echo $display_block;
include 'EndNavigation.php';
?>