



    var tag = document.createElement('script');
    var play = document.getElementById("play");
    var stop = document.getElementById("stop");
    var half = document.getElementById("half");
    var url = document.getElementById("url");
    var eject = document.getElementById("eject");
    var ytFrame = document.getElementById("playerFrame");
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var globalURL;
    var playlist = [];

    var speed;
    var time;
    var currentTime;

    var player;
    var done;


    function onPlayerReady(event) {
        time = event.target.getDuration();
        currentTime = event.target;
        console.log(player.getVideoUrl());

    }

    play.onclick = function () {
        player.playVideo();
        speed =  $('#volume_speed').val();
        player.setPlaybackRate(1);


    };
    

    $('#volume_speed').on("change", function() {
        console.log("jhghgj" + $(this).val());
        player.setPlaybackRate($(this).val());
        speed = $(this).val();
    });
 
  

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
        }
    }
    function StopVideo() {
        player.pauseVideo();
    }

    eject.onclick = function(){
        unloadVid();
    };

    function unloadVid(){
        speed = "unload";
        playnow("",false);
    }

    function playnow(url,playing) {
        if(playing == true) {

            playlist.push(url);
            var ytPlayer = document.createElement("div");
            ytPlayer.id = "ytPlayer";
            ytPlayer.setAttribute('class', "yt");
            ytPlayer.style.width = "200px";
            ytPlayer.style.visibility = "visible";
            ytFrame.appendChild(ytPlayer);

            onYouTubeIframeAPIReady();
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('ytPlayer', {
                    height: '200',
                    width: '200',
                    videoId: url,
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange,

                    }
                });

            }


                //StopVideo();
                //speed = "unload";
                //playnow("",false);
                //clearInterval(spin);
                //
        }else if (playing === false){

            ytFrame.removeChild(ytFrame.childNodes[0]);
        }

    }




