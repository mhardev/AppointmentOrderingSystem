$(document).ready(function () {

    function getData(data) {
        // Filter data to include only complete and cancelled statuses
        var filteredData = data.filter(function (item) {
            return item.order_status === 'Complete' || item.order_status === 'Cancelled';
        });

        $('#slsRepTbl').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            "aaData": filteredData,
            "order": [
                [6, "desc"]
            ],
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
        success: function (data) {
            getData(data);
        },
        error: function (error) {
            console.error("An error occurred:", error);
        }
    });
})
