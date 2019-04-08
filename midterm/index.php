<!DOCTYPE html>
<html>
    <head>
        <title>Midterm - Matchmaker</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container-fluid">
            <h1 id="name">Match</h1>
            
            <div id="menu" style="display:flex; flex-direction: row; align-items: center">
                <h3 id="curr"><a href="index.php">Match</a></h3><br />
                <h3><br>|<br></h3>
                <h3><a href="history.php">History</a></h3>
            </div>
            <br>
            <div>
                <div class="content">
                    <h2 id="decoration"></h2>
                    <p id="bio">
                    </p>
                    <img id="pic" />
                </div>
            </div>
            <br><br>
            <div id="buttons">
                <button id="like" onclick="nextMatch()">Like</button>
                <button id="meh" onclick="nextMatch()">?</button>
                <button id="dislike" onclick="nextMatch()">Dislike</button>
            </div>
        </div>
    </body>
    
    <script>
        /*global $*/
        
        var hold;
        var matchNum = 1;
        $.ajax({
           type: "GET",
           url: "gethistory.php",
           dataType: "json",
           data: {
                'userid' : '1'  
           },
           success: function(data, status) {
                console.log(data);
                $("#decoration").html("About @" + data[0]['username']);
                $("#bio").html(data[0]['about_me']);
                $("#pic").attr("src", data[0]['picture_url']);
                
                hold = data;
            }, 
           
           error: function(data, status) {
               console.log(status);
           }
        });
        
        function nextMatch() {
           $("#decoration").html("About @" + hold[matchNum]['username']);
            $("#bio").html(hold[matchNum]['about_me']);
            $("#pic").attr("src", hold[matchNum]['picture_url']);
            matchNum++;

            if (matchNum == hold.length - 1) {
                $("#like").attr("disabled", true);
                $("#meh").attr("disabled", true);
                $("#dislike").attr("disabled", true);
                alert("You have read and responded to all matches, well done!");
                document.location = "http://c9-cst336-nadolna-jnado.c9users.io/midterm/history.php";
            }
        }
                
    </script>
</html>