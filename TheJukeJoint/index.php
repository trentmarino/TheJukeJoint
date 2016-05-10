<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
<link rel="stylesheet" type="text/css" href="mainStyle.css">

<head>
    <title>Title</title>
    <meta charset="UTF-8">
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


<div id="bgDiv">
    <div id="leftBackgroundImage">
        <img src="leftBG2.png" height="100%" width="100%">
    </div>
    <div id="visualizer_wrapper">
        <canvas id='canvas' width="800" height="350" ></canvas>
    </div>
 
    <canvas id="needle"></canvas>
    <canvas id="turntable" height=" 500" width=" 600"></canvas>

    <canvas id="bgCanvas"></canvas>

    <div id="trackList">
        <div id="infoPanel">

        </div>
    </div>
    <div class="yt" id="playerFrame">

    </div>
    <div id="player" class="playing"></div>
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
    <menu id="controls">
        <button id="play">Play</button>
        <button id ="pause">Pause</button>
        <button id="stop">Stop</button>
        <button id="half">Half</button>
        <button id="eject">Eject</button>      
        <button id = "resume">Resume</button>
        <div>
        <input id = "volume_range" type="range" name="volume"  min="0" max="2" step="0.1" value="1" >
        <input id = "volume_speed" type="range" name="volume"  min="0.5" max="2" step="0.1" value="1" >
        </div>
    </menu>
    <script src="youtubePlayer.js"></script>


</div>




</body>
</html>