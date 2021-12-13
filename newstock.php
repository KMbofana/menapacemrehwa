
<?php 
  include('./admin/layout.php');
  include("./admin/link_bootstrap.php");
  include("./admin/link_datatable.php");

  session_start();
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Maxutra Order Tracking System</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" href="admin.php">Management <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="../newstock.php">New Inventory</a></li>
            <li><a href="order_admin_processing.php">Manage Stocks</a></li>
            <li><a href="order_admin_delivered.php">New Agents</a></li>
            <li><a href="order_admin_cancelled.php">Manage Agents</a></li>
          </ul>
        </li>
        <li><a href="order_admin_pending.php">Pending <span class="sr-only"></span></a></li>
        <li><a href="order_admin_processing.php">Processing</a></li>
        <li><a href="order_admin_delivered.php">Delivered</a></li>
        <li><a href="order_admin_cancelled.php">Cancelled</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Agents<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="order_admin_pending.php">Pending</a></li>
            <li><a href="order_admin_processing.php">Processing</a></li>
            <li><a href="order_admin_delivered.php">Delivered</a></li>
            <li><a href="order_admin_cancelled.php">Cancelled</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="destroy.php">Logout<?php echo"(".$_SESSION['username'].")";?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div style="margin-left:300px;">
<form class="form-horizontal" action="./stock.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Product Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="product_name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" placeholder="type assignment" name="price"><br/>                   
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Quantity</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" placeholder="type assignment" name="quantity"><br/>                   
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Product Image</label>
                    <div class="col-sm-4">
                    <input type="file" class="form-control-file" name="image">
                    </div>
                  </div>
                 
                  <div class="col-sm-4 panel-body" style="margin-left:120px;">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Add To Stocks</button>
                  </div>
                </form>
                </div>
