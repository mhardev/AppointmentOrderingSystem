$(document).ready(function () {

    function getData(data) {
        $('#recAccTbl').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            "aaData": data,
            "order": [
                [5, "desc"] 
            ],
            "columns": [
                { "data": "audit_id" },
                { "data": "user_id" },
                { "data": "user_type" },
                { "data": "activity" },
                { "data": "activity_details" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return row.audit_date + ' ' + row.audit_time;
                    }
                }
            ]
        })
    }

    $.ajax({
        url: 'APIs/AuditTrail/getRecentActivities.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            getData(data)
        },
        error: function (error) {
            console.error("An error occurred:", error);
        }
    });
})