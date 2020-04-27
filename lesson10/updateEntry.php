<?php
session_start();
include 'connection.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<h1>Select an Entry to Update</h1>";

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
		<p><label for=\"change_id\">Select a Record to Update:</label><br/>
		<select id=\"change_id\" name=\"change_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['id'];
			$display_name = stripslashes($recs['display_name']);
			$display_block .= "<option value=\"".$id."\">".$display_name."</option>";
		}

		$display_block .= "
		</select></p>
		<button class='btn-dark' type='submit' name='submit' value='change'>Change Selected Entry</button>
		</form>";
	}
	//free result
	mysqli_free_result($get_list_res);
} else if ($_POST) {
	//check for required fields
	if ($_POST['change_id'] == "")  {
		header("Location: updateEntry.php");
		exit;
	}

	//create safe version of ID
	$safe_id = mysqli_real_escape_string($mysqli, $_POST['change_id']);
	$_SESSION["id"]=$safe_id;

	//$_SESSION["fitnessgroup"]="true";
	
	
	//get participant_info
	$get_par_sql = "SELECT FirstName, LastName, Email, Phone, Department FROM participant WHERE id = '".$safe_id."'";
	$get_par_res = mysqli_query($mysqli, $get_par_sql) or die(mysqli_error($mysqli));

	while ($name_info = mysqli_fetch_array($get_par_res)) {
		$display_FirstName = stripslashes($name_info['FirstName']);
        $display_LastName = stripslashes($name_info['LastName']);	
        $display_email = stripslashes($name_info['Email']);
        $display_Phone = stripslashes($name_info['Phone']);
        $display_Department = stripslashes($name_info['Department']);		
    }
    $display_block = "<h1>Record Update</h1>";
	$display_block.="<form method='post' action='update.php'>";
	$display_block.="<fieldset><label>Participant Information:</label><br/>";
	$display_block.="<input type='text' name='FirstName' size='20' maxlength='30' required='required' value='" . $display_FirstName . "'/>";
    $display_block.="<input type='text' name='LastName' size='30' maxlength='30' required='required' value='" . $display_LastName . "'/>";
    $display_block.="<input type='text' name='Email' size='50' maxlength='50' required='required' value='" . $display_email . "'/>";
    $display_block.="<input type='text' name='Phone' size='10' maxlength='10' required='required' value='" . $display_Phone . "'/>";
    $display_block.="<input type='text' name='Department' size='20' maxlength='20' required='required' value='" . $display_Department . "'/></fieldset>";
    mysqli_free_result($get_par_res);
	//get all facilities
	/*$get_facility_sql = "SELECT Name, City, State, Zipcode
	                      FROM fitnessgroup WHERE id = '".$safe_id."'";
	$get_facility_res = mysqli_query($mysqli, $get_facility_sql) or die(mysqli_error($mysqli));
*/
 	
      //  mysqli_free_result($get_facility_res);

        $display_block .= "<p style='text-align: left;'><button class='btn-dark' type='submit' name='submitChange' id='submitChange' value='submitChange'>Change Entry</button>";
        $display_block .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href='mysubscriptionMenu.html' style='color:black';>Cancel and return to main menu</a></p></form>";
  }     
  //close connection to MySQL
mysqli_close($mysqli);      


?>
<?php include 'BeginNavigation.php'; ?>
<?php echo $display_block; ?>
<?php include 'EndNavigation.php'; ?>