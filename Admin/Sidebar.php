<aside id="sidebar">
  <div class="sidebar-title">
    <div class="sidebar-brand">
      <img src="Root/img/motojenlogofinal.png" class="sidebarLogo">
    </div>
    <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
  </div>

  <ul class="sidebar-list">
    <li class="sidebar-list-item">
      <a href="Dashboard.php" target="">
        <span class="material-icons-outlined">dashboard</span> Dashboard
      </a>
    </li>
    <li class="sidebar-list-item dropdown">
        <a href="#" class="dropdown-toggle" id="accountsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="material-icons-outlined">admin_panel_settings</span> Accounts
        </a>
        <ul class="dropdown-menu" aria-labelledby="accountsDropdown">
            <li><a class="dropdown-item" href="AdminAccounts.php">Admin Accounts</a></li>
            <li><a class="dropdown-item" href="Users.php">User Accounts</a></li>
        </ul>
    </li>
    <li class="sidebar-list-item">
      <a href="Product.php" target="">
        <span class="material-icons-outlined">inventory</span> Products
      </a>
    </li>
    <li class="sidebar-list-item">
      <a href="Services.php" target="">
      <span class="material-symbols-outlined">manufacturing</span> Services
      </a>
    </li>
    <li class="sidebar-list-item dropdown">
      <a href="#" class="dropdown-toggle" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="material-icons-outlined">receipt_long</span> Reports
      </a>
      <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
          <li><a class="dropdown-item" href="SalesReport.php">Sales Reports</a></li>
          <li><a class="dropdown-item" href="ServicesReport.php">Services Reports</a></li>
      </ul>
    </li>
    <li class="sidebar-list-item dropdown">
      <a href="#" class="dropdown-toggle" id="transactionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="material-symbols-outlined">contract</span> Transactions
      </a>
      <ul class="dropdown-menu" aria-labelledby="transactionsDropdown">
          <li><a class="dropdown-item" href="ProductOrder.php">Product Orders</a></li>
          <li><a class="dropdown-item" href="Appointments.php">Appointments</a></li>
      </ul>
    </li>
    <li class="sidebar-list-item dropdown">
        <a href="#" class="dropdown-toggle" id="accountsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="material-symbols-outlined">deployed_code_account</span> Supplier
        </a>
        <ul class="dropdown-menu" aria-labelledby="accountsDropdown">
            <li><a class="dropdown-item" href="Suppliers.php">Supplier Details</a></li>
            <li><a class="dropdown-item" href="SupplierProducts.php">Supplier Products</a></li>
        </ul>
    </li>
    <li class="sidebar-list-item">
      <a href="AuditTrail.php" target="">
        <span class="material-icons-outlined">content_paste_search</span> Audit Trail
      </a>
    </li>
    <li class="sidebar-list-item dropdown">
        <a href="#" class="dropdown-toggle" id="accountsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="material-icons-outlined">archive</span> Archive
        </a>
        <ul class="dropdown-menu" aria-labelledby="accountsDropdown">
            <li><a class="dropdown-item" href="AdminArchive.php">Archive Admins </a></li>
            <li><a class="dropdown-item" href="UsersArchive.php">Archive Users </a></li>
            <li><a class="dropdown-item" href="ProductArchive.php">Archive Products</a></li>
            <li><a class="dropdown-item" href="ServicesArchive.php">Archive Services</a></li>
            <li><a class="dropdown-item" href="SuppliersArchive.php">Archive Suppliers</a></li>
            <li><a class="dropdown-item" href="SupplierProductsArchive.php">Archive Supplier Products</a></li>
        </ul>
    </li>
  </ul>
</aside>