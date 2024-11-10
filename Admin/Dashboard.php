<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard</title>

  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="Root/css/styles.css">
  <link rel="stylesheet" href="Root/css/Main.css">
  <link rel="stylesheet" href="Root/css/Sidebar.css">
  <link rel="stylesheet" href="Root/css/Header.css">
  <link rel="stylesheet" href="Root/css/Dashboard/Charts.css">
  <link rel="stylesheet" href="Root/css/Dashboard/Cards.css">
  <link rel="icon" href="Root/img/motojenlogofinal.png" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="grid-container">
    <?php
    include('Config/dbcon.php');
    session_start();
    include('Validations/sessionChecker.php');
    include("Header.php");
    include("Sidebar.php");
    ?>
    <main class="main-container">
      <div class="main-title">
        <p class="font-weight-bold">Dashboard</p>
      </div>
      <div class="main-cards">
        <div class="card">
          <div class="card-inner">
            <p class="cardtext">Total Sales</p>
            <span class="material-icons-outlined text-blue">inventory_2</span>
          </div>
          <span class="cardtext font-weight-bold" id="TotalSales">0</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="cardtext">Total Orders</p>
            <span class="material-icons-outlined text-orange">add_shopping_cart</span>
          </div>
          <span class="cardtext font-weight-bold" id="TotalOrders">0</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="cardtext">Users</p>
            <span class="material-icons-outlined text-green">shopping_cart</span>
          </div>
          <span class="cardtext font-weight-bold" id="Users">0</span>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col col-md-6 col-sm-12 col-12 mt-3">
            <div class="box charts-card">
              <p class="chart-title">Income Report 2024</p>
              <div id="barChart"></div>
            </div>
          </div>
          <div class="col col-md-6 col-sm-12 col-12 mt-3">
            <div class="box charts-card">
              <p class="chart-title">Stocks Reports</p>
              <div id="pieChart"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col col-md-6 col-sm-12 col-12 mt-3">
            <div class="box charts-card">
              <p class="chart-title">Recent Appointment and Orders</p>
              <div class="container">
                <div class="row">
                  <div class="col" id="notif">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col col-md-6 col-sm-12 col-12 mt-3">
            <div class="box charts-card">
              <p class="chart-title">Products Breakdown</p>
              <div id="pieChart"></div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- End Main -->
    <?php
    include("Modal/Modals.php");
    ?>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- ApexCharts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
  <script src="Root/js/Dashboard/DashboardCards.js"></script>
  <script src="Root/js/Dashboard/DashboardBarChart.js"></script>
  <script src="Root/js/Dashboard/DashboardPieChart.js"></script>
  <script src="Root/js/Dashboard/RecentAppandOrders.js"></script>
  <script src="Root/js/Dashboard/Header.js"></script>
  <!-- Custom JS -->
  <script src="Root/js/Header.js"></script>
  <script src="Root/js/Sidebar.js"></script>
</body>

</html>