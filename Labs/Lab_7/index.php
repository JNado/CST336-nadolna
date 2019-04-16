<?php
    session_start();

    if (!isset($_SESSION['email'])){
      header("Location: login.html");
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/simple-line-icons.css" rel="stylesheet">
        
        <style>
            .modal {
              display: none; 
              position: fixed; 
              z-index: 1; 
              padding-top: 100px; 
              left: 0;
              top: 0;
              width: 100%; 
              height: 100%; 
              overflow: auto; 
            }
            
            .modal-content {
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 80%;
            }
            
            .close {
              float: right;
              font-size: 28px;
              font-weight: bold;
            }
        </style>
    </head>
    <body>
            <h1>Admin Dashboard</h1>
            <div>
                <button class="btn btn-danger">Logout</button>
            </div>
            
            <br>
            
            <h3>Insert New Record</h3>
            <div id="newitem">
                Name: <input type='text' id='pname'/>
                Description: <input type='text' id='pdesc'/>
                Image URL: <input type='text' id='image'/>
                Price: <input type='text' id='price'/>
                Category ID: <input type='text' id='cat'/>
                <input type='button' id='insertitem' value='Insert'/>
            </div>
            
            <br>
            
            <h3>Update Record</h3>
            <div id="updateitem">
                ID: <input type='text' id='up_id'/>
                Name: <input type='text' id='up_name'/>
                Description: <input type='text' id='up_desc'/>
                Image URL: <input type='text' id='up_image'/>
                Price: <input type='text' id='up_price'/>
                Category ID: <input type='text' id='up_cat'/>
                <input type='button' id='upitem' value='Update'/>
            </div>
            
            <br>
            
            <div id="results">
                
            </div>
        
            <div id="detailsModal" class="modal">
              <div class="modal-content">
                <p id="details"></p>
              </div>
            
            </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script>
        /*global $*/
        $(document).ready(function() {
            $.ajax ({
                type: "post",
                url: "dbOps.php",
                dataType: "json",
                data: {
                    "op" : "1"
                },
                success: function(data, status) {
                    // console.log(data);
                    
                    data.forEach(function(key) {
                        $("#results").append(key['productName'] + "<input class='editRecord' id='" + key['productId'] + "' type='button' value='Edit'/>" + 
                                                                    "<input class='delRecord' id='" + key['productId'] + "' type='button' value='Delete'/>" + 
                                                                    "<input class='itemdetails' id='" + key['productId'] + "' type='button' value='Details'/>" + 
                                                                    "<br>"); 
                    });
                },
                complete: function(data, status) { //optional, used for debugging purposes
                    // console.log(status);
                }
            });

            $("button").on("click", function() {
                window.location = "logout.php";
            })
            
            $(document).on('click', '.itemdetails', function() {
                $.ajax ({
                    type: "post",
                    url: "dbOps.php",
                    dataType: "json",
                    data: {
                        "op" : "4",
                        "pId" : $(this).attr("id")
                    },
                    
                    success: function(data, status) {
                        console.log(data);
                        
                        $("#details").html("ID: " + data.productId + "<br>" + 
                                            "Name: " + data.productName + "<br>" +
                                            "Description: " + data.productDescription + "<br>" +
                                            "Image URL: " + data.productImage + "<br>" +
                                            "Price: " + data.price + "<br>" +
                                            "Category ID: " + data.catId + 
                                            "<br><br>(Click outside of modal to exit)");
                                            
                        var modal = document.getElementById('detailsModal');
                        modal.style.display = "block";
                    },
                    
                    complete: function(data, status) { //optional, used for debugging purposes
                        // console.log(status);
                    }
                });
            })

            window.onclick = function(event) {
                var modal = document.getElementById('detailsModal');
                
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            $(document).on('click', '.delRecord', function() {
                if (confirm("Delete record with ID: " + $(this).attr("id"))) {
                    $.ajax ({
                        type: "post",
                        url: "dbOps.php",
                        dataType: "json",
                        data: {
                            "op" : "2",
                            "id" : $(this).attr("id")
                        },
                        success: function(data, status) {
                            // console.log(data);
                            // console.log(status);
                        },
                        complete: function(data, status) { //optional, used for debugging purposes
                            // console.log(data);
                        }
                    });
                }
            })

            $(document).on('click', '.editRecord', function() {
                $.ajax ({
                    type: "post",
                    url: "dbOps.php",
                    dataType: "json",
                    data: {
                        "op" : "4",
                        "pId" : $(this).attr("id")
                    },
                    
                    success: function(data, status) {
                        console.log(data);

                        $("#up_id").val(data.productId);
                        $("#up_name").val(data.productName);
                        $("#up_desc").val(data.productDescription);
                        $("#up_image").val(data.productImage);
                        $("#up_price").val(data.price);
                        $("#up_cat").val(data.catId);
                    },
                    complete: function(data, status) { //optional, used for debugging purposes
                        console.log(data);
                        console.log(status);
                    }
                });
            })
            
            $(document).on('click', '#insertitem', function() {
                $.ajax ({
                    type: "post",
                    url: "dbOps.php",
                    dataType: "json",
                    data: {
                        "op" : "3",
                        "name" : $("#pname").val(),
                        "desc" : $("#pdesc").val(),
                        "image" : $("#image").val(),
                        "price" : $("#price").val(),
                        "cat" : $("#cat").val(),
                     },
                    success: function(data, status) {
                        // console.log(data);
                        alert("Record inserted.");
                    },
                    complete: function(data, status) { //optional, used for debugging purposes
                        // console.log(data);
                        alert("Record inserted.");
                    }
                });
            })
            
            $(document).on('click', '#upitem', function() {
                $.ajax ({
                    type: "post",
                    url: "dbOps.php",
                    dataType: "json",
                    data: {
                        "op" : "5",
                        "pId" : $("#up_id").val(),
                        "name" : $("#up_name").val(),
                        "desc" : $("#up_desc").val(),
                        "image" : $("#up_image").val(),
                        "price" : $("#up_price").val(),
                        "cat" : $("#up_cat").val(),
                     },
                    success: function(data, status) {
                        // console.log(data);
                        alert("Record updated.");
                    },
                    complete: function(data, status) { //optional, used for debugging purposes
                        // console.log(data);
                        alert("Record updated.");
                    }
                });
            })
        })
        </script>
    </body>
</html>