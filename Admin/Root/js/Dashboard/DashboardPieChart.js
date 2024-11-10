$(document).ready(function () {
  $.ajax({
    url: 'APIs/DashboardAPI/getProductStock.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {

      var stocks = [];
      var category = [];
      var buyCount = [];
      data.forEach(item => { category.push(item.product_category) })
      data.forEach(item => { buyCount.push(item.buyCount) })
      data.forEach(item => { stocks.push(item.ProductStockCount) })
      console.log(stocks);
      console.log(buyCount);
      var options = {
        series: [{
          name: "Stock",
          data: stocks
        }, {
          name: "Deducted",
          data: buyCount
        }],
        chart: {
          type: 'bar',
          height: 430
        },
        plotOptions: {
          bar: {
            horizontal: true,
            dataLabels: {
              position: 'top',
            },
          }
        },
        dataLabels: {
          enabled: true,
          offsetX: -6,
          style: {
            fontSize: '12px',
            colors: ['#fff']
          }
        },
        stroke: {
          show: true,
          width: 1,
          colors: ['#fff']
        },
        tooltip: {
          shared: true,
          intersect: false
        },
        xaxis: {
          categories: category,
        },
      };

      var chart = new ApexCharts(document.querySelector("#pieChart"), options);
      chart.render();
    },
    error: function (error) {
      console.error("An error occurred:", error);
    }
  });



})