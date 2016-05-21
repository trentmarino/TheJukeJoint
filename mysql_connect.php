
<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "test";
$db_name = "JukeJoint";

// Create connection
$dbconnect = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check connection
if (mysqli_connect_errno()){
    echo mysqli_connect_error();
}
?>