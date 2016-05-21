<?php
include "mysql_connect.php";

$output=NULL;

    if(isset($_POST['submit'])){
        $nameq= $_POST['search'];
        $nameq= preg_replace("#[^0-9a-z]#i", "",$nameq);
        //-query  the database table
        $query = mysqli_query("SELECT * FROM jukejoint_database WHERE song_name LIKE '%$nameq%' OR artist_name LIKE '%$nameq%'") or die("Cannot Search!");
        if ($count == 0) {
            $output = 'No Results!';
        }
        else{
            while($row=mysqli_fetch_array($query, MYSQL_ASSOC)){
            $sname = $row['song_name'];
            $aname = $row['artist_name'];
            $id = $row['ic'];

            $output .= '<div> '.$sname.' '.$aname. '</div>';
            }
        }
    }
?>

<html>
<head>
    <title>Search</title>
</head>
<body>
<h1>The Juke Joint</h1>
<h2>Search and play your music</h2>

<form action="search.php" method="POST">
    <label>Song Name</label>
    <input  type="text"  name="search">
    <input  type="submit" name="submit" value="Search">
</form>

<?php

echo $output;

?>


