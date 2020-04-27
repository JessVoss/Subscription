<?php
session_start();
include 'connection.php';

    
    if (($_POST['FirstName'] == "") || ($_POST['LastName'] == "")) {
		header("Location: updateEntry.php");
		exit;
	}
	//connect to database
	doDB();
	//create clean versions of input strings
	        $id=$_SESSION["id"];
	        $safe_FirstName = mysqli_real_escape_string($mysqli, $_POST['FirstName']);
			$safe_LastName = mysqli_real_escape_string($mysqli, $_POST['LastName']);
			$safe_Phone = mysqli_real_escape_string($mysqli, $_POST['Phone']);
			$safe_email = mysqli_real_escape_string($mysqli, $_POST['Email']);
			$safe_Department = mysqli_real_escape_string($mysqli, $_POST['Department']);
			
                //update participant table
                $add_par_sql = "UPDATE participant SET id = '". $id . "', FirstName ='". $safe_FirstName ."', LastName ='". $safe_LastName ."', Phone='". $safe_Phone ."',
                                     Email ='". $safe_email ."', Department ='". $safe_Department ."'".
                                     "WHERE id=". $id;
                $add_par_res = mysqli_query($mysqli, $add_par_sql) or die(mysqli_error($mysqli));
            
             
/*
            if ($_SESSION["fitnessgroup"]=="true"){
                //update address table
                $add_fit_sql = "UPDATE fitnessgroup SET id=".$master_id."".
                                    ",Name='". $safe_Name ."', City='". $safe_City ."', State='". $safe_State .
                                    "', Zipcode='". $safe_Zipcode ."'".
                                     "WHERE id=".$id;
                $add_fit_res = mysqli_query($mysqli, $add_fit_sql) or die(mysqli_error($mysqli));
                }
             else if (($_POST['Name']) || ($_POST['city']) || ($_POST['state']) || ($_POST['zipcode'])) {
                //add new record to table
                $add_fit_sql = "INSERT INTO address (Name, City, State, Zipcode)  VALUES ('".
                                    $safe_Name."', '".$safe_city."','".$safe_state."' , '".$safe_zipcode."')";
                $add_fit_res = mysqli_query($mysqli, $add_fit_sql) or die(mysqli_error($mysqli));
            }*/
           mysqli_close($mysqli);
 
            $display_block = "<p>Your entry has been changed...</p>";
  ?>
<?php include 'BeginNavigation.php'; ?>
<?php echo $display_block; ?>
<?php include 'EndNavigation.php'; ?>