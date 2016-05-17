<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="HTML5 Audio Spectrum Visualizer">
    <title></title>
    <link type="text/css" rel="stylesheet" href="style/style.css">
</head>

<body>

<div id="wrapper">
    <div id="fileWrapper" class="file_wrapper" >
        <div id="info">
        </div>  
        <input type="text" id="youtube_link"  size="35"    placeholder="Input the Youtube link" onmouseover="this.style.borderColor='black';this.style.backgroundColor='blue'"  
style="width: 106; height: 21"  onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'" style="border-width:1px;border-color=black">
        <input type="button" value="Download the youtube mp3" class="styled-button-6"  id="fakeBrowse" onclick="HandleBrowseClick();"/>
        <input type="file" id="uploadedFile">
    </div>

</div>

<script>

    function HandleBrowseClick(ytURL) {

        var url = document.getElementById("youtube_link").value;
        var fileinput = document.getElementById("uploadedFile");
        var hint = "Please input the Youtube link";

        if (url != "")
            window.open('http://www.youtubeinmp3.com/fetch/?video=https://www.youtube.com/watch?v=' + ytURL, '_self', false);
        if (url === "") {
            document.getElementById("youtube_link").value = hint;
            return;
        }

    }

    function Handlechange() {
        var fileinput = document.getElementById("browse");
        var textinput = document.getElementById("filename");
        textinput.value = fileinput.value;

    }
    //requestAnimation Frame initialize
    (function () {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
                || window[vendors[x] + 'CancelRequestAnimationFrame'];
        }

        if (!window.requestAnimationFrame)
            window.requestAnimationFrame = function (callback, element) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                var id = window.setTimeout(function () {
                        callback(currTime + timeToCall);
                    },
                    timeToCall);
                lastTime = currTime + timeToCall;
                return id;
            };

        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = function (id) {
                clearTimeout(id);
            };
    }());


    // euqilaizer
    window.onload = function () {
        new Visualizer().ini();
    };

    // the spritesheet
    function sprite(options) {

        var that = {},
            frameIndex = 0,
            tickCount = 0,
            ticksPerFrame = options.ticksPerFrame || 0,
            numberOfFrames = options.numberOfFrames || 1;

        that.context = options.context;
        that.width = options.width;
        that.height = options.height;
        that.image = options.image;

        that.update = function (n) {

            tickCount += n;

            if (tickCount > ticksPerFrame) {

                tickCount = 0;

                // If the current frame index is in range
                if (frameIndex < numberOfFrames - 1) {
                    // Go to the next frame
                    frameIndex += 1;
                } else {
                    frameIndex = 0;
                }
            }
        };

        that.render = function () {

            // Clear the canvas
            that.context.clearRect(0, 0, that.width, that.height);

            // Draw the animation
            that.context.drawImage(
                that.image,
                frameIndex * that.width / numberOfFrames,
                0,
                that.width / numberOfFrames,
                that.height,
                130,
                -5,
                that.width / numberOfFrames,
                that.height);
        };

        return that;
    }


    var Visualizer = function () {
        this.file = null; //the current file
        this.fileName = null; //the current file name
        this.audioContext = null;
        this.source = null; //the audio source
        this.info = document.getElementById('info').innerHTML; //this used to upgrade the UI information
        this.infoUpdateId = null; //to sotore the setTimeout ID and clear the interval
        this.animationId = null;
        this.status = 0; //flag for sound is playing 1 or stopped 0
        this.forceStop = false;
        this.isStop = false;
        this.allCapsReachBottom = false;
        this.averageVolume = null; // the average volume value of music
        this.sum = 0;
        this.coin = sprite({
            context: canvas.getContext("2d"),
            width: 500,
            height: 72,
            image: null,
            numberOfFrames: 10,   //the number of frames
            ticksPerFrame: 8   //speed
        });
    };
    Visualizer.prototype = {
        ini: function () {
            this._prepareAPI();
            this._addEventListner();
        },
        _prepareAPI: function () {
            //fix browser vender for AudioContext and requestAnimationFrame
            window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.msAudioContext;
            window.requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.msRequestAnimationFrame;
            window.cancelAnimationFrame = window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || window.msCancelAnimationFrame;
            try {
                this.audioContext = new AudioContext();
            } catch (e) {
                this._updateInfo('!Your browser does not support AudioContext', false);
                console.log(e);
            }
        },
        _addEventListner: function () {
            var that = this,
                audioInput = document.getElementById('uploadedFile'),
                pauseButton = document.getElementById('pause'),
                resumeButton = document.getElementById('resume'),
                dropContainer = document.getElementsByTagName("canvas")[0];
            //listen the file upload
            audioInput.onchange = function () {
                if (that.audioContext === null) {
                    return;
                }
                ;
                //the if statement fixes the file selction cancle, because the onchange will trigger even the file selection been canceled
                if (audioInput.files.length !== 0) {
                    //only process the first file
                    that.file = audioInput.files[0];
                    that.fileName = that.file.name;
                    if (that.status === 1) {
                        //the sound is still playing but we upload another file, so set the forceStop flag to true
                        that.forceStop = true;
                    }
                    ;
                    document.getElementById('fileWrapper').style.opacity = 1;
                    that._updateInfo('Uploading', true);
                    //once the file is ready,start the visualizer
                    that._start();
                };
            };
           pauseButton.onclick = function(){
               StopVideo();
               speed = 0;
               that._audioPause();

           };

           resumeButton.onclick = function(){
               that._audioResume(that.analyser);
           };

        },
        _start: function () {
            //read and decode the file into audio array buffer
            var that = this,
                file = this.file,
                fr = new FileReader();
            fr.onload = function (e) {
                var fileResult = e.target.result;
                var audioContext = that.audioContext;
                if (audioContext === null) {
                    return;
                }
                ;
                that._updateInfo('Decoding the audio', true);
                audioContext.decodeAudioData(fileResult, function (buffer) {
                    that._updateInfo('Decode succussfully,start the visualizer', true);
                    that._visualize(audioContext, buffer);
                }, function (e) {
                    that._updateInfo('!Fail to decode the file', false);
                    console.log(e);
                });
            };
            fr.onerror = function (e) {
                that._updateInfo('!Fail to read the file', false);
                console.log(e);
            };
            //assign the file to the reader
            this._updateInfo('Starting read the file', true);
            fr.readAsArrayBuffer(file);

            //initial coin image
            coinImage = new Image();
            // coinImage.addEventListener("load", gameLoop);
            coinImage.src = "sprite-steps.png";
            that.coin.image = coinImage;
        },
        _visualize: function (audioContext, buffer) {
            var audioBufferSouceNode = audioContext.createBufferSource(),
            analyser = audioContext.createAnalyser(),
            that = this;
            //connect the source to the analyser
            audioBufferSouceNode.connect(analyser);
            //connect the analyser to the destination(the speaker), or we won't hear the sound
            analyser.connect(audioContext.destination);
            //then assign the buffer to the buffer source node
            audioBufferSouceNode.buffer = buffer;
            //play the source
            if (!audioBufferSouceNode.start) {
//                audioBufferSouceNode.start = audioBufferSouceNode.noteOn //in old browsers use noteOn method
                audioBufferSouceNode.stop = audioBufferSouceNode.noteOff //in old browsers use noteOff method
            }
            ;
            //stop the previous sound if any
            if (this.animationId !== null) {
                cancelAnimationFrame(this.animationId);
            }
            if (this.source !== null) {
                this.source.stop(0);
            }
              //volumne connect
        
        var gainNode = audioContext.createGain();
       
        audioBufferSouceNode.start(0);
        audioBufferSouceNode.connect(gainNode);
        gainNode.connect(audioContext.destination);
       
        document.getElementById('volume_range').addEventListener('change', function() {
                gainNode.gain.value = this.value;
        });
        
        document.getElementById('volume_speed').addEventListener('change', function() {
                audioBufferSouceNode.playbackRate.value = this.value;          
        });

        //start play

        this.status = 1;
        this.source = audioBufferSouceNode;
        this.analyser = analyser;
        audioBufferSouceNode.onended = function() {
            that._audioEnd(that);
        };
        this._updateInfo('Playing ' + this.fileName, false);
        this.info = 'Playing ' + this.fileName;
        document.getElementById('fileWrapper').style.opacity = 0.2;
        this._drawSpectrum(analyser);
 
        },
        
        _audioPause: function(){
           this.source.disconnect();
           this.isStop = true;
            },
    
        _audioResume: function(analyser){
         this.source.connect(analyser);
         this.isStop = false;
            },
        _drawSpectrum: function (analyser) {
            var that = this,
                canvas = document.getElementById('canvas'),
                cwidth = canvas.width  ,
                cheight = canvas.height  * 1.3 ,
                meterWidth = 10, //width of the meters in the spectrum
                gap = 2, //gap between meters
                capHeight = 2,
                capStyle = '#0338fd',
                meterNum = 360 / (10 + 2), //count of the meters
                capYPositionArray = []; ////store the vertical position of hte caps for the preivous frame
                ctx = canvas.getContext('2d'),
                gradient = ctx.createLinearGradient(0, 0, 0, 100);
                gradient.addColorStop(1, '#0d0e0d');
                gradient.addColorStop(0.5, '#0338fd');
                gradient.addColorStop(0, '#000');
                gradient.addColorStop(0, '#f00');

            var drawMeter = function () {
                var array = new Uint8Array(analyser.frequencyBinCount);
                analyser.getByteFrequencyData(array);
                if (that.status === 0) {
                    //fix when some sounds end the value still not back to zero
                    for (var i = array.length - 1; i >= 0; i--) {
                        array[i] = 0;
                    }
                    ;
                    allCapsReachBottom = true;
                    for (var i = capYPositionArray.length - 1; i >= 0; i--) {
                        allCapsReachBottom = allCapsReachBottom && (capYPositionArray[i] === 0);
                    }
                    ;
                    if (allCapsReachBottom) {
                        cancelAnimationFrame(that.animationId);
                        //since the sound is stoped and animation finished, stop the requestAnimation to prevent potential memory leak,THIS IS VERY IMPORTANT!
                        return;
                    }
                    ;
                }
                ;
                var step = Math.round(array.length / meterNum); //sample limited data from the total array
                ctx.clearRect(0, 0, cwidth, cheight);
                for (var i = 0; i < meterNum; i++) {
                    var value = array[i * step];
                    that.sum += array[i * step];

                    if (capYPositionArray.length < Math.round(meterNum)) {
                        capYPositionArray.push(value);
                    }
                    ;
                    ctx.fillStyle = capStyle;
                    //draw the cap, with transition effect
                    if (value < capYPositionArray[i]) {
                        ctx.fillRect(i * 12, cheight - (--capYPositionArray[i]), meterWidth, capHeight );
                    } else {
                        ctx.fillRect(i * 12, cheight - value, meterWidth, capHeight);
                        capYPositionArray[i] = value;
                    }
                    ;
                    ctx.fillStyle = gradient; //set the filllStyle to gradient for a better look
                    ctx.fillRect(i * 12 /*meterWidth+gap*/, cheight - value + capHeight, meterWidth, cheight ); //the meter
                }
                that.averageVolume = that.sum / (array.length) * 2;
                that.sum = 0;

                that.coin.update(that.averageVolume);
                if(that.isStop == false)
                that.coin.render();

                that.animationId = requestAnimationFrame(drawMeter);


            }

            this.animationId = requestAnimationFrame(drawMeter);


        },

        _audioEnd: function (instance) {
            if (this.forceStop) {
                this.forceStop = false;
                this.status = 1;
                return;
            }
            ;
            this.status = 0;
            var text = 'HTML5 Audio API showcase | An Audio Viusalizer';
            document.getElementById('fileWrapper').style.opacity = 1;
            document.getElementById('info').innerHTML = text;
            instance.info = text;
            document.getElementById('uploadedFile').value = '';
        },
        _updateInfo: function (text, processing) {
            var infoBar = document.getElementById('info'),
                dots = '...',
                i = 0,
                that = this;
            infoBar.innerHTML = text + dots.substring(0, i++);
            if (this.infoUpdateId !== null) {
                clearTimeout(this.infoUpdateId);
            }
            ;
            if (processing) {
                //animate dots at the end of the info text
                var animateDot = function () {
                    if (i > 3) {
                        i = 0
                    }
                    ;
                    infoBar.innerHTML = text + dots.substring(0, i++);
                    that.infoUpdateId = setTimeout(animateDot, 250);
                }
                this.infoUpdateId = setTimeout(animateDot, 250);
            }
            ;
        }
    }

</script>
</body>


</html>