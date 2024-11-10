$(document).ready(function(){

    function getData(data){
        var filteredData = data.filter(function (item) {
            return item.status === 'Complete' || item.status === 'Cancelled';
        });
        $('#servRepTbl').dataTable( {
            "aaData": filteredData,
            "order": [
                [3, "desc"] 
            ],
            "columns": [
                { "data": "id" },
                { "data": "user_id" },
                { "data": "services_name" },
                { "data": "appointment_date" },
                { "data": "appointment_type" },
                { "data": "total_cost" },
                { "data": "status" }
            ]
        })  
    }


    $.ajax({
        url: 'APIs/ServicesAPI/getAppointments.php',
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