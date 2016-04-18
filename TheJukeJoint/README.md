# ytdl-dash

youtube-dl wrapper for downloading dash movies. Requires php, youtube-dl and avconv (ffmpeg).

For the future, I think there are two possible plans:

1. Start integrating with youtube-dl
 * I want as many of the ideas in here into youtube-dl as possible!
 * I have no idea what it would take to do this though
2. Make this thing compete with youtube-dl
 * I think youtube-dl is needlessly complicated anyway!
 * I have plenty of ideas in the TODO ;)

Generally, it seems that completeness is the grand goal in improving this project. We want to do MORE different stuff

## Usage
* php ytdl.php <url>
* When installed: ytdl <url>

## Installing
Short:
* copy ytdl.php to /usr/local/bin/ytdl and make sure it has correct permissions (root:root, 755)
* Path is optional if you wondered

Slow:
* apt-get install php5-cli youtube-dl ffmpeg
* Download this
* sudo cp ytdl.php /usr/local/bin/ytdl
* sudo chmod 755 /usr/local/bin/ytdl
* sudo chown root:root /usr/local/bin/ytdl

## How does it even...?
* uses youtube-dl to get a list of formats
* uses youtube-dl to get the name of the file
* makes a temporary folder inside /tmp (random name)
* makes two pipes in that directory, video & audio
* downloads video to /tmp/<name>/video
* downloads audio to /tmp/<name>/audio
* uses avconv to mux it to a file in your current directory
* Should be finished as soon as both downloads are done afaik
* deletes temporary folder

## Issues / Todo
Note: This list is a lot of wishlist mixed up with things I'll have to do..

* Python port (note to self: zeus contains a start)
* Backgrounding of the downloading jobs should be done in a controlled manner
* Selective sub downloading
* Selective formats, or other forms of intelligent format selection (1080p but not higher?)
* Select *any* combination of formats, the mkv can handle it. Try tagging streams by source (webm/mp4/3gp/flv XXXXp, Dash/regular)
* For the time, 720p video seems to contain the least compressed audio, so this needs to be another option
* The final mkv should embed metadata (always - I don't want to make a needlessly complicated tool.)
* Minimalize unneccesary requests. Doing the same request twice is a waste of time
* See what we can do of parallelization and download acceleration
* Autoupdater, it would be wonderful to pull from git with commandline option
* Can we download the absolutely irritating captions and make softsubs of them?
* Can we download playlists and stuff like youtube-dl does?

## Changelog
* It takes multiple videos now (Thanks, isync)
* Better temp name generation
* Download the highest video formats
* Better checking for already-existing files
