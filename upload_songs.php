<?php

include "mysql_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $song_name = $_POST["song_name"];
    $artist_name = $_POST["artist_name"];
    $duration= $_POST["duration"];
    $youtube_url=$_POST["youtube_url"];
    $video_id=$_POST["video_id"];
    echo $id . "  ". $song_name . "  " . $artist_name . "  " . $duration . "  " . $youtube_url . "  " . $video_id;
    }

else{
    echo "Please enter all details";
}

$sql = "INSERT INTO jukejoint_database (id, song_name, artist_name, duration, youtube_url, video_id)
VALUES ('$id','$song_name','$artist_name','$url')";

if (!empty($conn)) {
    if ($conn->query($sql) == TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

