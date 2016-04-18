(function(){


    var trackList = document.getElementById('trackList');
    var request = new XMLHttpRequest();
    request.open('POST','get_songs.php');
    request.onreadystatechange = function() {
        if ((request.readyState === 4) && (request.status === 200)) {
           var jsonOBJ = JSON.parse(request.responseText);
            console.log(JSON.parse(request.responseText));


    for(var i = 0; i < jsonOBJ.length; i++) {
        var bob = "name" + i;
        var innerDiv = document.createElement('div');
        innerDiv.setAttribute('class', "song");
        innerDiv.setAttribute('id', jsonOBJ[i].song_url);
        trackList.appendChild(innerDiv);
        console.log(jsonOBJ[i].song_title);
        console.log(jsonOBJ[i].song_url);

        innerDiv.innerHTML = "<h2>" + jsonOBJ[i].song_title + "</h2>";
        //innerDiv.innerHTML = "<img src=https://upload.wikimedia.org/wikipedia/commons/0/08/Vinyl_LP.jpg width='100' height='100'><img>";

    }
        $('.song').draggable({
            appendTo: 'body',
            helper: 'clone'
        });

        $("#player").droppable({
            drop: function (event, ui) {
                var dropDiv = $(this);
                var record = ui.draggable;
                console.log("placed" + JSON.stringify(ui.draggable.attr('id')));
                playnow(ui.draggable.attr('id'));
                record.appendTo(dropDiv);
            }

        });



        }
    };
    request.send();

})();