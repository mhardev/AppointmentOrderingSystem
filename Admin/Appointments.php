<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointments</title>
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
  <!-- Custom CSS -->
  <link rel="icon" href="Root/img/motojenlogofinal.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="Root/css/styles.css">
  <link rel="stylesheet" href="Root/css/Main.css">
  <link rel="stylesheet" href="Root/css/Sidebar.css">
  <link rel="stylesheet" href="Root/css/Header.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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
        <p class="font-weight-bold">Appointments</p>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="box">
              <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Start Date</span>
                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="box">
              <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">End Date</span>
                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="box">
              <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#orderModal">
                <span class="mx-1"><i class="bi bi-funnel"></i></span>Filter
              </button>
            </div>
          </div>
          <div class="col">
            <div class="box">
              <button type="button" class="btn btn-danger mb-3">
                <span class="mx-1"><i class="bi bi-filetype-pdf"></i></span>
              </button>
              <button type="button" class="btn btn-success mb-3">
                <span class="mx-1"><i class="bi bi-file-earmark-excel"></i></span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table id="servRepTbl" class="table table-striped table-sm" style="width:100%">
          <thead>
            <tr class="table-dark">
              <th>ID</th>
              <th>User ID</th>
              <th>Service Name</th>
              <th>Appointment Date</th>
              <th>Appointment Type</th>
              <th>Total Cost</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class=table-group-divider>

          </tbody>
        </table>
      </div>
    </main>
    <?php
    include("Modal/Modals.php");
    ?>
  </div>
  <script src="Root/js/Dashboard/Header.js"></script>
  <!-- Custom JS -->
  <script src="Root/js/Header.js"></script>
  <script src="Root/js/Sidebar.js"></script>
  <script src="Root/js/Services/Appointment.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- Datatables -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>