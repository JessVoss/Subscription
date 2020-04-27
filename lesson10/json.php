<?php
$mysqli = mysqli_connect("localhost", "root", "", "Subscription");
//$mysqli = mysqli_connect("localhost", "lisabalbach_voss18", "CIT180137", "lisabalbach_voss18");

$query = "SELECT * FROM participant";
//$results = mysqli_query($mysqli, $query) or die (mysqli_error($mysqli));

$results = $mysqli->query($query) or die(mysqli_error($mysqli));
$response = array();

$post = array();

while($row= $results-> fetch_assoc())
{
            $FirstName = $row['FirstName'];
            $LastName = $row['LastName'];
            $Email = $row['Email'];
            $Phone = $row['Phone'];
            $Department = $row['Department'];
            $post[] = array('FirstName'=> $FirstName, 'LastName'=> $LastName, 'Email'=>$Email, 'Phone' => $Phone, 'Department'=> $Department);
}
$response['participant'] = $post;

$fp = fopen('participant.json','w');
fwrite($fp, json_encode($response));
fclose($fp);
include 'BeginNavigation.php';
$display = "<p>The participant information has been written to json </p>";
$display .= "<p><a href= 'viewjson.php'>View Participant info</p>";
echo $display;
include 'EndNavigation.php';
        ?>
        
        