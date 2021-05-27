$(function (){
    $('[name="radio-type"]:radio').change(function(){
        var type = $(this).val();
        if(type == 1){
            document.getElementById('input-key').disabled = true;
        }
        else{
            document.getElementById('input-key').disabled = false;
        }
    });

    $('[name="join_public_room"]:button').click(function(){
        
    });

    $('#find-room').click(function(){
        $.ajax({
            type: "POST",
            url: "../model/dbAction.php",
            dataType: "json",
            data: {
                action: $('#action').val(),
            },
        }).done(function (data){
            var name = ['ID', 'Name', 'Type', ''];

            let parent = document.getElementById('room_table');

            while(parent.lastChild){
                parent.removeChild(parent.lastChild);
            }

            // var theadElem = parent.createTHead();
            // var trElem = theadElem.insertRow();

            var write = `<tr>`;
            name.forEach(element => {
                write += `<th>${element}</th>`;

                // var cellElem = document.createElement('th');
                // cellElem.appendChild(document.createTextNode(element));
                // trElem.appendChild(cellElem); 
            });
            write += `</tr>`;

            data['rooms'].forEach(element => {
                write += `<tr>
                <form action="../view/room.php" method="POST">
                <td>${element['peer_id']}</td><td>${element['name']}</td><td>${element['type']}</td>
                <td><input class="btn btn-primary my-2 join_public_room" type="button" value="Join" class="join_room_button"></td>
                <input type="hidden" name="room-name" value="${element['name']}">
                </form>
                </tr>`;
                // let newRow = parent.insertRow();

                // let newCell = newRow.insertCell();
                // let newText = document.createTextNode(element['peer_id']);
                // newCell.appendChild(newText);

                // let newCell = newRow.insertCell();
                // let newText = document.createTextNode(element['name']);
                // newCell.appendChild(newText);

                // let newCell = newRow.insertCell();
                // let newText = document.createTextNode(element['type']);
                // newCell.appendChild(newText);
            });
            // parent.write(write);
            // parent.html(write);
            $("#room_table").append(write);


            console.log(data);
            
        }).fail(function (msg, XMLHttpRequest, textStatus, errorThrown){
            $('#alert').replaceWith('<div class="alert alert-danger" id="alert" role="alert"> ' + msg + ' </div>');
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        })
    });
});