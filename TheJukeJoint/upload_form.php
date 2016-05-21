<html>
<head>
    <title>Upload Songs</title>
</head>
<body>
<h1>The Juke Joint</h1>
<h2>Upload your Music</h2>

<form action="upload_songs.php" method="POST" enctype="multipart/form-data"
    <label>File</label>
    <input type="file" name="file">
    <label>Song Name</label>
    <input type="text" name="songname">
    <label>Artist Name</label>
    <input type="text" name="artistname">
    <label>Youtube URL</label>
    <input type="text" name="youtubeurl">
    <button type="submit" name="upload_button">upload</button>
</form

</body>
</html>