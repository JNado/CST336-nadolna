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
            <h1 id="name">History</h1>
            
            <div id="menu" style="display:flex; flex-direction: row; align-items: center">
                <h3><a href="index.php">Match</a></h3><br />
                <h3><br>|<br></h3>
                <h3><a href="history.php">History</a></h3>
            </div>
            <br>
            <div>
                <div class="content">
                    <table id="prod">
                        <tr>
                            <th>Username</th>
                            <th>Status</th>
                            <th>When</th>
                            <th>Details</th>
                        </tr>
                    </table>

                </div>
            </div>
            <br><br>
            <div id="buttons">
            </div>
        </div>
    </body>
    
    <script>
        /*global $*/
        $.ajax({
           type: "GET",
           url: "getmatch.php",
           dataType: "json",
           data: {
                'userid' : '1'  
           },
           success: function(data, status) {
                console.log(data);
                data.forEach(function(key) {
                    $("#prod").append("<tr><td>"+ key['username'] + "</td><td>"+ key['answer_type_id'] + "</td><td>"+ key['answer_timestamp'] + "</td><td><a onclick='modal()'>Details</a></td></tr>");    
                }); 
            }, 
            
           error: function(data, status) {
               console.log(status);
           }
        });
        

    </script>
</html>