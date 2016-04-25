<?php

include 'db_connect.php';

$response = array();

$sql = "SELECT * FROM songs";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
//    $response["tracks"] = array();
    while($row = $result->fetch_assoc()) {
        $product = array();
        $product["song_id"] = $row["song_id"];
        $product["song_title"] = $row["song_title"];
        $product["artist_name"] = $row["artist_name"];
        $product["song_url"] = $row["song_url"];

        array_push($response, $product);
    }
    print(json_encode($response));
}

?>