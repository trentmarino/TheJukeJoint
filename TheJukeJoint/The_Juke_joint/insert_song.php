<?php

include "db_connect.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $song = $_POST["song_name"];
    $artist = $_POST["artist"];
    $url = $_POST["url"];
    echo $song . "  hhh" . $artist . "  " . $url;
}else{
    echo "zxdfghjcxfcvbnm";
}

$sql = "INSERT INTO songs (song_title, artist_name, song_url)
VALUES ('$song','$artist','$url')";





if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

