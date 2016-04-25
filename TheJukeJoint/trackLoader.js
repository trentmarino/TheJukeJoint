(function () {


    var trackList = document.getElementById('trackList');
    var infoPanel = document.getElementById('infoPanel');
    var request = new XMLHttpRequest();
    var state;
    var idArray = [];
    request.open('POST', 'get_songs.php');
    var record = [];
    var currentlyplaced = 0;

    request.onreadystatechange = function () {
        if ((request.readyState === 4) && (request.status === 200)) {
            var jsonOBJ = JSON.parse(request.responseText);
            console.log(JSON.parse(request.responseText));
            loadTackk(jsonOBJ);
            displayInformation(jsonOBJ);
        }
    };

    function displayInformation(jsonOBJ) {
        $('.song').click(function () {
            $("#infoPanel").animate({
                width: 'toggle'
            });
            var songInfo = document.createElement('div');
            songInfo.setAttribute('class', "info");
            console.log($(this).attr('text'));

            for (var j = 0; j < jsonOBJ.length; j++) {
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                if($(this).attr('text') === jsonOBJ[j].song_id){
                    console.log("the song is " + $(this).attr('text'));
                    console.log("the song is " + jsonOBJ[j].song_title);
                    songInfo.innerHTML = "<h2 >" + jsonOBJ[j].song_title + "</h2>" + "<h2 >" +
                        jsonOBJ[j].artist_name + "</h2>";
                }


            }
            infoPanel.appendChild(songInfo);
        });
    }

    function loadTackk(jsonOBJ) {
        for (var i = 0; i < jsonOBJ.length; i++) {
            var bob = "name" + i;
            var innerDiv = document.createElement('div');
            innerDiv.setAttribute('class', "song");
            innerDiv.setAttribute('id', jsonOBJ[i].song_url);
            innerDiv.setAttribute('text', jsonOBJ[i].song_id);
            idArray.push(jsonOBJ[i].song_id);
            trackList.appendChild(innerDiv);
            console.log(jsonOBJ[i].song_title);
            console.log(jsonOBJ[i].song_url);
            innerDiv.innerHTML = "";
            innerDiv.innerHTML = "<p><h2 id='disc'>" + jsonOBJ[i].song_title + "</h2>" +
                "<img id='trackImage' src=record2.png width='200' height='200'><img>" +
                "<h2 id='disc_artist'>" + jsonOBJ[i].artist_name + "</h2></p>";

        }


        $('.song').draggable({
            appendTo: 'body',
            helper: 'clone'
        });
        //playnow("", true);

        $("#player").droppable({

            drop: function (event, ui) {
                console.log("placed" + JSON.stringify(ui.draggable.attr('id')));
                console.log("id" + JSON.stringify(ui.draggable.attr('value')));

                if (speed != "load") {
                    playnow(ui.draggable.attr('id'), true);
                    record[0] = ui.draggable.attr('id');
                    speed = "load";

                } else if (speed === "load" && record[0] != ui.draggable.attr('id')) {
                    unloadVid();
                    playnow(ui.draggable.attr('id'), true);
                    record[0] = ui.draggable.attr('id');
                    speed = "load";

                }


                console.log("loaded previous" + record[0]);
                var dropDiv = $(this);
            }


        });
    }

    request.send();

})();