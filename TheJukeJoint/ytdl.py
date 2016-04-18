#!/usr/bin/python
# -*- coding: utf-8 -*-
import sys
import tempfile
import os
import subprocess


# START DEFINES

# Makes a temporary directory with pipes
def maketemp():
    tmp=tempfile.mkdtemp('', 'ytdl-', '/tmp')
    print "Temporary directory: "+tmp
    os.mkfifo(tmp+"/audio", 0600)
    os.mkfifo(tmp+"/video", 0600)
    return tmp

# Undoes that ^^
def deltemp(tmp):
    os.remove(tmp+"/audio")
    os.remove(tmp+"/video")
    os.rmdir(tmp)

# hellohello was just too cheezy
def greet(video):
    print "|" + ("="*70)+"|"
    print "| "+video
    print "|" + ("="*70)+"|"

def command(x, tmp):
    p = subprocess.Popen(x, stdout=subprocess.PIPE, cwd=tmp)
    out = p.communicate()
    return out[0].strip()

def download(vid, tmp):
    audio_out = tmp+"/audio"
    video_out = tmp+"/video"
    
    print "Getting filename"
    print command(['youtube-dl', '--get-filename', vid], tmp)


# END DEFINES



if len(sys.argv) < 2:
    print "Usage: python " + sys.argv[0] + " <video> [, <video>], .."
    sys.exit(1)

tmp = maketemp()

for vid in sys.argv[1:]:
    greet(vid)
    download(vid,tmp)

deltemp(tmp)



#function extreplace($name, $ext){
#	$pos = strrpos($name, ".");
#	if($pos === false) return "$name.$ext";
#	return substr($name, 0, $pos).".$ext";
#}
#
#function download($vid, $tmp){
#	$temp = escapeshellarg($tmp);
#	$url = escapeshellarg($vid);
#	$audio_out = escapeshellarg($tmp."/audio");
#	$video_out = escapeshellarg($tmp."/video");
#
#	echo "Getting filename for $vid:\n";
#	$cmd = "(cd $temp; youtube-dl --get-filename $url)";
#	$out = trim(`$cmd`);
#	$out = extreplace($out, "mkv");
#
#	if(file_exists($out)){
#		echo "Cannot download, file already exists.\n";
#		return;
#	}
#
#	echo "Getting formats for $vid:\n";
#	$cmd = "(cd $temp; youtube-dl -F $url | grep DASH | sed 's/\t\t*/ /g' | cut -d ' ' -f 1)";
#	$data = explode("\n", trim(`$cmd`));
#	$fmt = array();
#	foreach($data as $f){
#		$f = intval($f);
#		$fmt[$f]=true;
#	}
#
#	$audio = 0;
#	if(isset($fmt[172])) $audio=172;	// 256k webm
#	else if(isset($fmt[140])) $audio=140;	// 128k m4a
#	else listfmt($vid);
#
#	$video = 0;
#	if(isset($fmt[138])){ $video=138; echo "Yay for >1080p content!\n"; } // 1440p DASH?
#	else if(isset($fmt[137])) $video=137;		// 1080p DASH
#	else if(isset($fmt[136])) $video=136;		// 720p DASH
#	else if(isset($fmt[135])) $video=135;		// 480p DASH
#	else if(isset($fmt[134])) $video=134;		// 360p DASH
#	else if(isset($fmt[133])) $video=133;		// 480p DASH
#	else listfmt($vid);
#
#	$cmd = "(cd $temp; youtube-dl $url -f $video -o $video_out & youtube-dl $url -f $audio -o $audio_out & ) 1>&2";
#	`$cmd`;
#	avconv("$tmp/audio", "$tmp/video", $out);
#}
#
#function avconv($aud,$vid,$out){
#	$aud = escapeshellarg($aud);
#	$vid = escapeshellarg($vid);
#	$out = escapeshellarg($out);
#	echo ($cmd = "avconv -i $aud -i $vid -c copy $out 1>&2")."\n";
#	`$cmd`;
#}
#function listfmt($vid){
#	$url = escapeshellarg($vid);
#	$cmd = "(youtube-dl $url -F) 1>&2";
#	`$cmd`;
#	die();
#}
