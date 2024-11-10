$(document).ready(function(){
    $.ajax({
        url: 'APIs/DashboardAPI/getTotalSales.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var options = {
                series: [{
                data: Object.values(data[0])
              }],
                chart: {
                type: 'bar',
                height: 350
              },
              plotOptions: {
                bar: {
                  borderRadius: 4,
                  horizontal: true,
                }
              },
              dataLabels: {
                enabled: false
              },
              xaxis: {
                categories: months,
              }
              };
      
              var chart = new ApexCharts(document.querySelector("#barChart"), options);
              chart.render();
        },
        error: function(error) {
            console.error("An error occurred:", error);
        }
    });
})
    
    