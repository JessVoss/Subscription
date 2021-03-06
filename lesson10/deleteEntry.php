<?php
include 'connection.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<h1>Select an entry for deletion</h1>";

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
			$display_block .= "<option value=\"".$id."\">".$display_name."</option>";
		}

		$display_block .= "
		</select></p>
	<button class='btn-dark' type='submit' name='submit' value='view'>Submit</button>

	</form>";
	}
	//free result
	mysqli_free_result($get_list_res);
} else if ($_POST) {
	//check for required fields
	if ($_POST['sel_id'] == "")  {
		header("Location: delentry.php");
		exit;
	}

    //create safe version of ID
    $safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);

	//issue queries
	$del_master_sql = "DELETE FROM participant WHERE id = '".$safe_id."'";
	$del_master_res = mysqli_query($mysqli, $del_master_sql) or die(mysqli_error($mysqli));

	$del_participant_sql = "DELETE FROM participantgroup  WHERE ParticipantID = '".$safe_id."'";
	$del_participant_sql = mysqli_query($mysqli, $del_fitness_sql) or die(mysqli_error($mysqli));


	mysqli_close($mysqli);

	$display_block = "<h1>Record(s) Deleted</h1><p>Would you like to
	<a href=\"".$_SERVER['PHP_SELF']."\">delete another</a>?...Return to the <a href='mysubscriptionMenu.html'>main menu</a>?</p>";
}
?>
<?php include 'BeginNavigation.php'; ?>
<?php echo $display_block; ?>
<?php include 'EndNavigation.php'; ?>