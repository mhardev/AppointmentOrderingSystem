$(document).ready(function(){

    function getData(data){
        $('#slsRepTbl').dataTable( {
            "aaData": data,
            "columns": [
                { "data": "id" },
                { "data": "user_id" },
                { "data": "name" },
                { "data": "number" },
                { "data": "payment_method" },
                { "data": "address" },
                { "data": "total_price" },
                { "data": "place_on" },
                { "data": "order_status" }
            ]
        })  
    }

    $.ajax({
        url: 'APIs/SalesAPI/getBilling.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            getData(data)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });
})