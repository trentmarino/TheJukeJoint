/**
 * Created by trentmarino on 16/04/2016.
 */
(function() {


    console.log("opened script");
    var stage = new createjs.Stage("list");
    var canvas = document.getElementById("list");

    var offset = new createjs.Point();
    var xbase = 50;
    var ybase = 120;
    var cont = new createjs.Container();
    function discs() {
        var record = new createjs.Shape();
        var label = new createjs.Text("drag me", "bold 14px Arial", "#FFFFFF");
        label.textAlign = "center";
        record.graphics.beginFill("black").drawCircle(50, 10, 100);
        record.x = xbase;
        record.y = ybase;
        label.x = xbase + 50;
        label.y = ybase;
        ybase += 250;
        canvas.height = ybase;
        cont.addChild(record,label);
    }

    for (var i = 0; i < 10; i++) {
        discs();

    }
    stage.addChild(cont);
    stage.update();

})();



//var div = document.createElement("div");
//for(var i = 0;i < 5; i++) {
//    var canvas = document.createElement('canvas');
//    var ctx = canvas.getContext("2d");
//    div = document.getElementById("tracks");
//    canvas.id = "tracko";
//    canvas.width = 200;
//    canvas.height = 200;
//    canvas.style.zIndex += i;
//    canvas.style.position = "relative";
//    canvas.style.display = "list-item";
//    canvas.style.left = "50px";
//    canvas.style.marginTop = "20px";
//    canvas.style.overflow = "scroll";
//    canvas.style.border = "1px solid";
//    div.style.height = "600px";
//    div.style.width = "300px";
//    div.style.overflow = "scroll";
//    div.style.backgroundColor = "black";
//
//    ctx.fillStyle ="blue";
//    ctx.fillRect(50,50,100,100);
//    div.appendChild(canvas);
//    var canvas2 = document.getElementById("tracko");
//}