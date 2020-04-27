<?php
	include 'Connection.php';
	doDB();

	if (!$_POST)  {
		//haven't seen the selection form, so show it
		$display_block = "<h1>Select an Entry</h1>"; 

	$get_list_sql = "SELECT id,
					CONCAT_WS(', ', LastName, FirstName) AS display_name
					FROM participant ORDER BY LastName, FirstName";
	$get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_list_res) < 1) {
		//no records
		$display_block .= "<p><em>Sorry, no records to select!</em></p>";
	}
	else {
		//has records, so get results and print in a form
		$display_block .= "
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		<p><label for=\"sel_id\">Select a Record:</label><br/>
		<select id=\"sel_id\" name=\"sel_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";
		
		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['id'];
			$display_name = stripslashes($recs['display_name']);
			$display_block .= "<option value=\"".$id."\">".$display_name."</option>";
		}
	
	$display_block .= "
	</select></p>
	<button class='btn-dark' type='submit' name='submit' value='view'>View Selected Entry</button>
	</form>";
}
	mysqli_free_result($get_list_res);

	}else if ($_POST) {
		//check for required fields
		if ($_POST['sel_id'] == "")  {
			header("Location: subscribers.php");
			exit;
		}
		//create safe version of ID
	$safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
	
	//get participant info
	$get_participant_sql = "SELECT concat_ws(' ', FirstName, LastName) as display_name, Phone, email, Department
	                   FROM participant WHERE id = '".$safe_id."'";
	$get_participant_res = mysqli_query($mysqli, $get_participant_sql) or die(mysqli_error($mysqli));

//$get_participant_sql = "SELECT participant.FirstName,participant.LastName,participant.Phone,fitnessgroup.Name AS 'Fitness Group'
 //FROM participant Join participantgroup ON participant.ID = participantgroup.ParticipantID Join fitnessgroup ON participantgroup.FitnessGroupID = fitnessgroup.ID "; 
 
	while ($name_info = mysqli_fetch_array($get_participant_res)) {
		$display_name = stripslashes($name_info['display_name']);
		$Phone = stripslashes($name_info['Phone']);
		$email = stripslashes($name_info['email']);
		$Department = stripslashes($name_info['Department']);
		//$Name= stripslashes($name_info['Name']);
	}

	$display_block = "<h1>Showing Record for ".$display_name."</h1>";
	$display_block .= "<h2> phone: $Phone <br> email: $email <br> department: $Department </h2>";
//free result
mysqli_free_result($get_participant_res);

//get all participantgroup
/*$get_facility_sql = "SELECT FitnessgroupID, ParticipantID
					  FROM participantGroup WHERE ParticipantID = '".$safe_id."'";
$get_facility_res = mysqli_query($mysqli, $get_facility_sql) or die(mysqli_error($mysqli));
*/

//get all fitnessgroups
/*$get_facility_sql = "SELECT Name, city, state, zipcode
					  FROM fitnessgroup WHERE  id = ";
$get_facility_res = mysqli_query($mysqli, $get_facility_sql) or die(mysqli_error($mysqli));
*/
/*$get_facility_sql = "SELECT Name, FitnessGroupID FROM fitnessgroup Join participantGroup On ID = FitnessGroupID";
$get_facility_res = mysqli_query($mysqli, $get_facility_sql) or die(mysqli_error($mysqli));

 if (mysqli_num_rows($get_facility_res) > 0) {

	$display_block .= "<p><strong>FitnessGroup:</strong><br/>
	<ul>";

	while ($fac_info = mysqli_fetch_array($get_facility_res)) {
		$address = stripslashes($add_info['Name']);
		
		$display_block .= "<li>$address </li>";
	}

	$display_block .= "</ul>";
}*/
//free result
mysqli_free_result($get_facility_res);
}
//close connection to MySQL
	mysqli_close($mysqli);
	
?>
<?php include 'BeginNavigation.php'; ?>
<?php echo $display_block; ?>
<?php include 'EndNavigation.php'; ?>