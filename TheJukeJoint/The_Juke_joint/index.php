
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="mainstyle.css">
    <script></script>
    <script src="https://code.createjs.com/easeljs-0.8.2.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<?php
include "db_connect.php";
?>

<body>
<form id="insert_songs" action="insert_song.php" method="post">
    <label>Song name</label>
    <input type="text" id="song_name" name="song_name">
    <label>artist</label>
    <input type="text" id="artist" name="artist">
    <label>Image</label>
    <input type="file" id="art"  name="art">
    <label>URL</label>
    <input type="text" id="url" name="url">
    <button type="submit" id="submit">submit</button>
</form>

<button id="play">Play</button>
<button id="stop">Stop</button>
<button id="half">Half</button>
<br>
<div id="player" class="playing"></div>
<div id="trackList"></div>
<script src="trackLoader.js"></script>
<script>
    $('#insert_songs').submit(function() {
        var trackTitle = url.value.split("=");
        console.log(trackTitle[1]);
        url.value = trackTitle[1];
        return true;
    });
</script>
<div id="ytPlayer"></div>
<script src="youtubePlayer.js"></script>
</body>
</html>
