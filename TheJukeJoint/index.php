<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
<link rel="stylesheet" type="text/css" href="mainStyle.css">

<head>
    <title>Title</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="mainstyle.css">
    <link rel="stylesheet" type="text/css" href="grid.css">
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
    <input type="file" id="art" name="art">
    <label>URL</label>
    <input type="text" id="url" name="url">
    <button type="submit" id="submit">submit</button>
</form>
<?php
include "equalizer.php";
?>
<script>a

</script>

<div class="row container">

    <div id="visualizer_wrapper">
        <canvas id='canvas' width="800" height="350"></canvas>
    </div>
    <div id="trackList" class="col trackList">
        <div id="infoPanel">

        </div>
    </div>
   
    <div class="col player">
        <canvas id="needle"></canvas>
        <canvas id="turntable" height=" 500" width=" 600"></canvas>
        <div id="player" class="playing"></div>
        <canvas id="recordCanvas" class="recordCanvas"></canvas>
    </div>
    <script src="trackLoader.js"></script>
    <script>
        $('#insert_songs').submit(function () {
            var trackTitle = url.value.split("=");
            console.log(trackTitle[1]);
            url.value = trackTitle[1];
            return true;
        });
    </script>
    <script src="controller.js"></script>
    <div class="col ytPlayer">
        <div class="yt" id="playerFrame">
        </div>
    </div>
    <div class="col controls">
        <button id="play">Play</button>
        <button id="pause">Pause</button>
        <button id="eject">Eject</button>
        <button id="resume">Resume</button>
        <div>
            <input id="volume_range" type="range" name="volume" min="0" max="2" step="0.1" value="1">
            <input id="volume_speed" type="range" name="volume" min="0" max="2" step="0.5" value="1"  list="steplist">
            <datalist id="steplist">
                <option>0</option>
                <option>0.5</option>
                <option>1</option>
                <option>1.5</option>
                <option>2</option>
            </datalist>
        </div>
    </div>
</div>

    <script src="youtubePlayer.js"></script>
</body>
</html>