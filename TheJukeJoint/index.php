<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
<link rel="stylesheet" type="text/css" href="mainStyle.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<link rel="stylesheet" type="text/css" href="style/buttons.css">
<link rel="stylesheet" type="text/css" href="grid.css">
<script type="text/javascript">
    //auto expand textarea
    function adjust_textarea(h) {
        h.style.height = "20px";
        h.style.height = (h.scrollHeight) + "px";
    }
</script>
<head>
    <title>Title</title>
    <meta charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="mainstyle.css">
        <link rel="stylesheet" type="text/css" href="style/style.css">
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

<?php
include "search.php";
?>
<div class="row container">
    <div class="col insertSongs">
        <h2>Search and play your music</h2>

        <form action="search.php" method="POST">
            <label>Song Name</label>
            <input  type="text"  name="search">
            <input  type="submit" name="submit" value="Search">
        </form>
        <?php
        echo $output;
        ?>
        <?php
        include "upload_form.php";
        ?>
        <form id="insert_songs" action="insert_song.php" method="post">
            <ul>
                <span>Add a new song: </span>
                <input type="text" id="song_name" name="song_name" maxlength="100" placeholder="Song Name"
                       onmouseover="this.style.borderColor='black';this.style.backgroundColor='blue'"
                       style="width: 106; height: 21"
                       onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'"
                       style="border-width:1px;border-color=black">
                <input type="text" id="artist" name="artist" maxlength="50" placeholder="Artist"
                       onmouseover="this.style.borderColor='black';this.style.backgroundColor='blue'"
                       style="width: 106; height: 21"
                       onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'"
                       style="border-width:1px;border-color=black">
                <input type="text" id="url" name="url" placeholder="URL"
                       onmouseover="this.style.borderColor='black';this.style.backgroundColor='blue'"
                       style="width: 106; height: 21"
                       onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'"
                       style="border-width:1px;border-color=black">
                <button type="submit" id="submit" class="styled-button-5">submit</button>

            </ul>
        </form>
    </div>
    <div id="trackList" class="col trackList">
        <div id="infoPanel">
        </div>
    </div>
    <div class="col player">
        <canvas id="needle"></canvas>
        <canvas id="turntable" height=" 500" width=" 600"></canvas>
        <div id="player" class="playing"></div>
        <canvas id="recordCanvas" class="recordCanvas" width="1000" height="800"></canvas>
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
        <button id="play" class="styled-button-7">Play</button>
        <button id="pause" class="styled-button-7">Pause</button>
        <button id="eject" class="styled-button-7">Eject</button>
        <button id="resume" class="styled-button-7">Resume</button>
        <div>
            <input id="volume_range" type="range" name="volume" min="0" max="2" step="0.1" value="1">
            <input id="volume_speed" type="range" name="volume" min="0" max="2" step="0.5" value="1" list="steplist">
            <datalist id="steplist">
                <option>0</option>
                <option>0.5</option>
                <option>1</option>
                <option>1.5</option>
                <option>2</option>
            </datalist>
        </div>
        <div id="fileWrapper" class="file_wrapper">
            <div style="margin-top: 5%" id="info">
            </div>
        </div>
        <div id="visualizer_wrapper">
            <canvas id='canvas'></canvas>
        </div>
    </div>
    <div class="col youtubeForm">
        <input type="text" id="youtube_link" size="35" placeholder="Input the Youtube link"
               onmouseover="this.style.borderColor='black';this.style.backgroundColor='blue'"
               style="width: 106; height: 21"
               onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'"
               style="border-width:1px;border-color=black">
        <input type="button" value="Download the youtube mp3" class="styled-button-6" id="fakeBrowse"
               onclick="HandleBrowseClick();"/>
        <input type="file" id="uploadedFile">
        <?php
        include "equalizer.php";
        ?>
    </div>
</div>
<div class="row choosesong">
<!--    <div class="col youtubeForm">-->
<!--        <input type="text" id="youtube_link" size="35" placeholder="Input the Youtube link"-->
<!--               onmouseover="this.style.borderColor='black';this.style.backgroundColor='blue'"-->
<!--               style="width: 106; height: 21"-->
<!--               onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'"-->
<!--               style="border-width:1px;border-color=black">-->
<!--        <input type="button" value="Download the youtube mp3" class="styled-button-6" id="fakeBrowse"-->
<!--               onclick="HandleBrowseClick();"/>-->
<!--        <input type="file" id="uploadedFile">-->
<!--        --><?php
//        include "equalizer.php";
//        ?>
<!--    </div>-->
</div>


<script src="youtubePlayer.js"></script>

</body>
</html>