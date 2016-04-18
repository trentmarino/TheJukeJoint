
    var tag = document.createElement('script');
    var play = document.getElementById("play");
    var stop = document.getElementById("stop");
    var half = document.getElementById("half");
    var url = document.getElementById("url");
    var form = document.getElementById("insert_songs");
    var submit = document.getElementById("submit1");
    var YTUrl;
    var vidloader = false;
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


    var player;
    var done;
    function onPlayerReady(event) {
        play.onclick = function () {
            console.log("dfgdsgdgsd");
            event.target.playVideo();
        };
    }

    stop.onclick = function () {
        StopVideo();
    };
    half.onclick = function () {
        player.setPlaybackRate(0.5);
    };

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
        }
    }
    function StopVideo() {
        player.pauseVideo();
    }
    if(vidloader === true){
        playnow();
    }
    function playnow (url) {
        //YTUrl = url.value;
        //console.log("url is " + YTUrl);
        //YTUrl = splitter();
        //console.log("url is " + YTUrl);

        onYouTubeIframeAPIReady();
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('ytPlayer', {
                height: '200',
                width: '200',
                videoId: url,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
    };


