<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Practice 7: Discount Store (Midterm)</title>
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <h1> Discount Shopping </h1>

        <table id="prod">
            <tr>
                <th>Product</th>
                <th width="100">Unit <br> Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            
            <br>

            <tr>
                <td id="produ"></th>
                <td id="unit"></th>
                <td id="quan">
                    <input type="text" name="quantity1" />
                </th>
            </tr>
            
            <tr>
                <td id="produ1">
                    <select id="prods" name="products">
                        <option>Select One</option>
                    </select>
                </th>
                <td id="unit1"></th>
                <td id="quan1"></th>
            </tr>

        </table>
        <br><br>
        <label>Promo Code:</label><input id="promo" type="text" size="15"><button id="btn" onclick="apiCall()">Find Discount</button><br>
        
        <div>
            <label id="subtotal"></label><br>
            <label id="tax"></label><br>
            <label id="total"></label>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="purchaseHistoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">>Product History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="history"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    /*global $*/
    $.ajax({
        type: "post",
        url: "getProducts.php",
        dataType: "json",
        data: {},

        success: function(data, status) {
            // console.log(data);
            var rand = Math.floor(Math.random(0, data.length));
            
            $("#produ").html(data[rand]['productName']);
            $("#unit").html(data[rand]['productPrice']);

            data.forEach(function(key) {
                $("[name=products]").append("<option value=" + key["productId"] + ">" + key["productName"] + "</option>"); 
            });
        }
    });
    
    $("#prods").change(function() {
        alert("hai"); 
    });
</script>

</html>
