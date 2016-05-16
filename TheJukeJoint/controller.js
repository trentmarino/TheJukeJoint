/**
 * Created by trentmarino on 22/04/2016.
 */


(function (){
    var recordCanvas = document.getElementById('bgCanvas');
    var ncanvas = document.getElementById("needle");
    ncanvas.width = 500;
    ncanvas.height = 500;
    var needleCanvas = new createjs.Stage(ncanvas);
    var ctxRecord = recordCanvas.getContext('2d');
    var img = new Image();
    var turntableCanvas = document.getElementById('turntable');
    var ctxTurntable = turntableCanvas.getContext('2d');
    var stopPlaying;
    var imageObj = new Image();

    needleimg = new Image();
    needleimg.src = 'needle.png';
    needleimg.onload = function (event) {

        var bitmap = new createjs.Bitmap(needleimg);
        bitmap.scaleX = 0.9;
        bitmap.scaleY = 0.9;
        bitmap.x = 310;
        bitmap.y = 0;
        bitmap.regX = 300;
        bitmap.regY = 0;

        createjs.Ticker.on("tick", tick);
        createjs.Ticker.setFPS(60);


        needleCanvas.addChild(bitmap);


        function tick(event) {

            //console.log(" rotation " + bitmap.rotation);
            //console.log(" speed " + speed);

            if (speed === $('#volume_speed').val()) {
                if (bitmap.rotation <= 16 || bitmap.rotation > 354) {
                    bitmap.rotation += (time/1000)/300 * $('#volume_speed').val();
                }else{
                    bitmap.rotation = 355;

                }
            }else if (speed === "load") {
                bitmap.rotation = 330;
            }else if(speed === "unload"){
                if(bitmap.rotation < 330){
                    bitmap.rotation -= 1;
                }
                bitmap.rotation = 330;
            }
            else{
                bitmap.rotation = 330;

            }
            needleCanvas.update(); // important!!

        }


    };

    function spiningRecord() {

        var ang = 0;
        var fps = 1000 / 60;
        img.onload = function () {
            recordCanvas.width = this.width << 1;
            recordCanvas.height = this.height << 1;
            var cache = this;
            var spin = setInterval(function () {
                ctxRecord.save();

                if (speed ===  $('#volume_speed').val()) {
                    ctxRecord.translate(cache.width / 1.225, cache.height / 0.9); //let's translate
                    ctxRecord.rotate(Math.PI / 180 * (ang += 4) * ($('#volume_speed').val())); //increment the angle and rotate the image
                    ctxRecord.drawImage(img, -cache.width / 1.535, -cache.height / 1.535, cache.width * 1.3, cache.height * 1.3); //draw the image ;)
                    console.log(time);
                    console.log(currentTime.getCurrentTime());
                    stopPlaying = time - currentTime.getCurrentTime();
                    if (stopPlaying < 1) {
                        playnow("", false);
                        speed = 0;
                    }
                } else if (speed === 0) {
                    ctxRecord.translate(cache.width / 1.225, cache.height / 0.9); //let's translate
                    ctxRecord.rotate(Math.PI / 180 * (ang += 0)); //increment the angle and rotate the image
                    ctxRecord.drawImage(img, -cache.width / 1.535, -cache.height / 1.535, cache.width * 1.3, cache.height * 1.3); //draw the image ;)
                }

                else if (speed === "load") {
                    ctxRecord.translate(cache.width / 1.225, cache.height / 0.9); //let's translate
                    ctxRecord.drawImage(img, -cache.width / 1.535, -cache.height / 1.535, cache.width * 1.3, cache.height * 1.3); //draw the image ;)
                }
                else if (speed === "unload") {
                    ctxRecord.clearRect(0, 0, recordCanvas.width, recordCanvas.height);
                    clearInterval(spin);
                    spiningRecord();
                }

                ctxRecord.restore(); //restore the state of recordCanvas
            }, fps);
        };
        img.src = 'record.png'; //img

    }


    function drawPlayer() {

        imageObj.onload = function () {
            ctxTurntable.drawImage(imageObj, turntableCanvas.width / 15, turntableCanvas.height / 4.3, 900 / 1.75, 660 / 2);
        };
        imageObj.src = 'recordPlayer.png';
    }
    spiningRecord();

    drawPlayer();


})();