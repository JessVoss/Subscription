<?php
include 'connection.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<h1>Select a participant </h1>";

	//get parts of records
	$get_list_sql = "SELECT id,
	                 CONCAT_WS(', ', LastName, FirstName) AS display_name
	                 FROM participant ORDER BY LastName, FirstName";
	$get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_list_res) < 1) {
		//no records
		$display_block .= "<p><em>Sorry, no records to select!</em></p>";

	} else {
		//has records, so get results and print in a form
		$display_block .= "
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		<p><label for=\"sel_id\">Select a Record:</label><br/>
		<select id=\"sel_id\" name=\"sel_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['id'];
			$display_name = stripslashes($recs['display_name']);
			$display_block .= "<option  value=\"".$id."\">".$display_name."</option>";
		}
	}
	$display_block .= "
	</select></p>";
//</form>";

	mysqli_free_result($get_list_res);
	
	$display_block .= "<h1>Select a fitness group </h1>";
	//get parts of records
	$get_fitlist_sql = "SELECT id, name
	                 FROM fitnessgroup ORDER BY name";
	$get_fitlist_res = mysqli_query($mysqli, $get_fitlist_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_fitlist_res) < 1) {
		//no records
		$display_block .= "<p><em>Sorry, no records to select!</em></p>";

	} else {
		//has records, so get results and print in a form
		$display_block .= 
		//<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		"<p><label for=\"sel_fitid\">Select a Record:</label><br/>
		<select id=\"sel_fitid\" name=\"sel_fitid\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysqli_fetch_array($get_fitlist_res)) {
			$id = $recs['id'];
			$display_name = stripslashes($recs['name']);
			$display_block .= "<option value=\"".$id."\">".$display_name."</option>";
		}
	
		$display_block .= "
		</select></p>
	<button class='btn-dark' type='submit' name='submit' value='view'>submit</button>
	</form>";

}
	
	//free result
	mysqli_free_result($get_fitlist_res);
}else{
		//check for required fields
		/*if ($_POST['sel_id']=="")  {
			header("Location: participantGroup.php");
			exit;
		}*/
		//clean versions
		$safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
		
		$safe_fitid = mysqli_real_escape_string($mysqli, $_POST['sel_fitid']);
		

			// add to participantgroup  table
		
			$add_participant_sql = "INSERT INTO participantgroup ( FitnessGroupID, ParticipantID)  VALUES ('".$safe_fitid."','".$safe_id."')";
			$add_participant_res = mysqli_query($mysqli, $add_participant_sql) or die(mysqli_error($mysqli));
		
			//$display_block = "fitness group was added to the participant.";
			$display_block = "<h1>Record(s) Fitness GroupAdded</h1><p>Would you like to
			<a href=\"".$_SERVER['PHP_SELF']."\">Add another</a>?...Return to the <a href='mySubscriptionMenu.html'>main menu</a>?</p>";

			mysqli_close($mysqli);
	}
	?>
	<?php include 'BeginNavigation.php'; ?>
	<?php echo $display_block; ?>
	<?php include 'EndNavigation.php'; ?>