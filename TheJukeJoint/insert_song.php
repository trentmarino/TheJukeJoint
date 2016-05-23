<?php

include "db_connect.php";

//
//    $song = $_POST["song"];
//    $artist = $_POST["artist"];
//    $url = $_POST["url"];

if(isset($_POST['song_name'])){$song=$_POST['song_name'];}
if(isset($_POST['artist'])){$artist=$_POST['artist'];}
if(isset($_POST['url'])){$url=$_POST['url'];}

echo $song . "  " . $artist . "  " . $url;


//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $song = $_POST["song_name"];
//    $artist = $_POST["artist"];
//    $url = $_POST["url"];
//    echo $song . "  " . $artist . "  " . $url;
//}else{
//    echo "zxdfghjcxfcvbnm";
//}

$sql = "INSERT INTO songs (song_title, artist_name, song_url)
VALUES ('$song','$artist','$url')";





if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

