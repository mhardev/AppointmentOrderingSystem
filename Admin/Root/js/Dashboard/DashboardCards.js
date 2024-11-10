$(document).ready(function(){
    $.ajax({
        url: 'APIs/DashboardAPI/getCardsContent.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $("#TotalSales").text('₱' + data[0].TotalSales)
            $("#TotalOrders").text(data[0].Orders)
            $("#Users").text(data[0].Users)
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });
})