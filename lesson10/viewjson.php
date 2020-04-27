
<?php  

$participants = file_get_contents("participant.json");
//display in php
        $display="<div id='participant'><h1>Participants</h1>";

        $display="<div id='participant'><h1>Participants</h1>";
        $participantObj = json_decode($participants);
        foreach ($participantObj->participant as $par){
            $FirstName = $par->FirstName;
            $LastName = $par->LastName;
            $Email = $par->Email;
            $Phone = $par->Phone;
            $Department = $par->Department;
            $display .= "<h2>" . $FirstName .  " " . $LastName. "</h2>" . "<p><br>Email: " . $Email .  "<br>Phone: " . $Phone . "<br>Department: " .$Department. "</p>";
        }
        $display .= "<div>";
        include 'BeginNavigation.php';
        echo $display;
        include 'EndNavigation.php';
            ?>

        