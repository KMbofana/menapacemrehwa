<?php 
include("layout.php");
include("config.php");
include("link_bootstrap.php");
include("link_datatable.php");

?>
<!-- new nav -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Maxutra Reliable Energy Solutions</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">Management</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../newstock.php">New Inventory</a></li>
            <li><a class="dropdown-item" href="order_admin_processing.php">Manage Stocks</a></li>
            <li><a class="dropdown-item" href="order_admin_delivered.php">New Agents</a></li>
            <li><a class="dropdown-item" href="order_admin_cancelled.php">Manage Agents</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order_admin_pending.php">Pending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order_admin_processing.php">Processing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order_admin_delivered.php">Delivered</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order_admin_cancelled.php">Cancelled</a>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Agents <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="../newstock.php">New Inventory</a></li>
            <li><a href="order_admin_processing.php">Manage Stocks</a></li>
            <li><a href="order_admin_delivered.php">New Agents</a></li>
            <li><a href="order_admin_cancelled.php">Manage Agents</a></li>
          </ul>
        </li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="destroy.php">Logout<?php echo"(".$_SESSION['username'].")";?></a></li>
      </ul>
    
    </div>
  </div>
</nav>
<!-- new nav ends -->