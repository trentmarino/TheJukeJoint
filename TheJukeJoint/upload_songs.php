<?php

include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $song_name = $_POST["song_name"];
    $artist_name = $_POST["artist_name"];
    $duration= $_POST["duration"];
    $youtube_url=$_POST["youtube_url"];
    $video_id=$_POST["video_id"];
    echo $song_name . "  " . $artist_name . "  " . $youtube_url;
    }

else{
    echo "Please enter all details";
}

$sql = "INSERT INTO jukejoint_database (song_name, artist_name, youtube_url)
VALUES ('$song_name','$artist_name','$youtube_url')";

if (!empty($conn)) {
    if ($conn->query($sql) == TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

