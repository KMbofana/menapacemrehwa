<?php
include("layout.php");
include("config_2.php");
include('link_datatable.php');
include('link_bootstrap.php');

session_start();
if(!isset($_SESSION['username'])){
	header('location: login.php');
}

if($_SESSION['type']=='admin'){
	include("menu_admin_2.php");
}else{
	include("menu_customer.php");
}
?>


<script type="text/javascript">
	function delivered(id,phone,status){
		var json={
			id:id,
			phone:phone,
			status:status
		}
		xhttp= new XMLHttpRequest();
		xhttp.open('POST','data_order_admin_delivered.php',true);
		xhttp.setRequestHeader('Content-Type','application/json');
		xhttp.send(JSON.stringify(json));

		window.location.reload()
			
		

	}

	function cancelled(id,phone,status){
		console.log(id,phone,status)
		
		var json={
			id:id,
			phone:phone,
			status:status
		}

		xhttp= new XMLHttpRequest();
		xhttp.open('POST','data_order_admin_cancelled.php');
		xhttp.setRequestHeader('Content-Type','application/json');
		xhttp.send(JSON.stringify(json))
		window.location.reload()
	}

</script>

		
<?php
	include('link_bootstrap.php'); 
?>
		
		
<div class="container">
		
	<div class="alert alert-danger" id="flash-error" hidden>
		<strong>Opss.. There was an error! Try again with valid input</strong>
	</div>
	<div class="alert alert-success" id="flash-product-ordered" hidden>
	    <strong>Product has been Ordered Successfully!</strong>
	</div>
	<div class="alert alert-danger" id="flash-order-cancel" hidden>
	    <strong>Order has been cancelled!</strong>
	</div>
	<div class="alert alert-success" id="flash-order-update" hidden>
	    <strong>Order has been Updated!</strong>
	</div>
	

	<div id="modal_order_update" class="modal fade" role="dialog">
	    <div class="modal-dialog">

		    <!-- Modal for updating order quantity-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Update Order</h4>
		      </div>
		      <div class="modal-body">
		        <p>Please provide correct input.</p>
		        <form>
		        	<div class="form-group">
				    	<label>Order Id:</label>
				    	<input disabled type="text" class="form-control" id="order_id" name="order_id">
				    </div>
		        	<div class="form-group">
				    	<label>Product:</label>
				    	<input disabled type="text" class="form-control" id="order_product_name" name="order_product_name">
				    </div>
				    <div class="form-group">
				    	<label>Customer:</label>
				    	<input disabled type="text" class="form-control" id="order_customer_name" name="order_customer_name">
				    </div>
				    <div class="form-group">
				    	<label>Date of Order:</label>
				    	<input disabled type="text" class="form-control" id="date_of_order" name="date_of_order">
				    </div>
				    <div class="form-group">
				    	<label>Quantity:</label>
				    	<input disabled type="text" class="form-control" id="order_quantity" name="order_quantity">
				    </div>
				    <div class="form-group">
				    	<label>Status:</label>
				    	<select class="form-control" id='order_status'>
				    		<option value="processing">Processing</option>
							<option value="pending">Pending</option>
							<option value="delivered">Delivered</option>
							<option value="cancelled">Cancelled</option>
						</select>
				    </div>
		        </form>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" id="order_update_confirm" class="btn btn-success" data-dismiss="modal">Update</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		      </div>
		    </div>

	    </div>
	</div>


	
	<div style="text-align: center"><h3>Processing Orders</h3></div>
	<table id="order_admin_processing" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Order Id</th>
				<th>Customer</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Status</th>
				
				<th>Action</th>
			</tr>
		</thead>
		<?php
			
	
			$getPendingOrder=mysqli_query($con,"SELECT * FROM `paid_for_items` WHERE `status`='Items in transit' ORDER BY `phone`");
			while($result=mysqli_fetch_assoc($getPendingOrder)){
	?>
	<tr>

		<td><input type="text" data-column="0" style="width:50px; border-style:none;" class="search-input-text" value="<?php echo $result['paid_id']; ?>"></td>
		<td><input type="text" data-column="1"  class="search-input-text" value="<?php echo $result['full_name']; ?>"></td>
		<td><input type="text" data-column="2"  class="search-input-text" value="<?php echo $result['email']; ?>"></td>
		<td><input type="text" data-column="3"  class="search-input-text"  value="<?php echo $result['phone']; ?>"></td>
		<td><input type="text" data-column="4" style="width:100px; border-style:none;" class="search-input-text" value="<?php echo $result['status']; ?>"></td>
		<td colspan="2">
			<div style="display:flex; flex-direction:row;">
				<input type="button" data-column="5" style="margin:5px;" class="search-input-text" id="delivering_<?php echo $result['paid_id'];?>" value="Delivered" onclick="delivered(<?php echo $result['paid_id'];?>,<?php echo $result['phone'];?>,'<?php echo $result['status'];?>')">
				<input type="button" data-column="6" style="margin:5px;" id="cancelled_<?php echo $result['paid_id'];?>" onclick="cancelled(<?php echo $result['paid_id']; ?>,<?php echo $result['phone'];?>,'<?php echo $result['status'];?>')" value="Cancelled">
			</div>
		</td>
	
	</tr>
	<?php }?>
	</table>
	<p><br><br><br><br></p>
	
</div>

<?php include('footer.php')?>