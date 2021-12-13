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


<!-- <script>
	$(document).ready(function() {
		var dataTable = $('#order_admin_pending').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax":{
				url :"data_order_admin_pending.php", // json datasource
				type: "post",  // method  , by default get
				
				error: function(){  // error handling
					$(".order_admin_pending-error").html("");
					$("#order_admin_pending").append('<tbody class="order_admin_pending-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#order_admin_pending_processing").css("display","none");
					
				}
			},
			
		} );
		
		$("#order_admin_pending_filter").css("display","none");  // hiding global search box
		$('.search-input-text').on( 'keyup', function () {   // for text boxes
			var i =$(this).attr('data-column');  // getting column index
			var v =$(this).val();  // getting search input value
			dataTable.columns(i).search(v).draw();
		} );
		
		$("#order_admin_pending").on("click", "td button", function(e) {
			
			var value = $(this).text();
			//alert(value);
			if(value == 'Update'){
				//alert('clicked');
				// code for updating order quantity
				var quantity = $(this).parent().prev().text();
				var date_of_order = $(this).parent().prev().prev().text();
				var user_id = $(this).parent().prev().prev().prev().text();
				var product = $(this).parent().prev().prev().prev().prev().text();
				var order_id = $(this).parent().prev().prev().prev().prev().prev().text();
				//alert(order_id);

				$('#order_id').val(order_id);
				$('#order_product_name').val(product);
				$('#order_customer_name').val(user_id);
				$('#date_of_order').val(date_of_order);
				$('#order_quantity').val(quantity);

				$('#modal_order_update').modal('show');

			}else{
				// nothing to do
			}

			
		});

		$("#order_update_confirm").on("click", function(e) {
			//alert('clicked');
			var order_id = $('#order_id').val();
			var order_status = $('#order_status option:selected').val();
			//alert(order_status);

			 
			$.ajax({
				method: "POST",
			    url : "order_update_backend_admin.php",
			    data : {order_id:order_id, order_status:order_status},
			    dataType: 'html',
			    success: function(data, textStatus, jqXHR)
			    {
			        //data = response from server
			        console.log(data);
			        if(data=='valid'){
			        	//$('#flash-success').show();
			        	$('#flash-order-update').show();
			        	dataTable.ajax.reload(null, false);
			        }else{
			        	//nothin to do
			        	$('#flash-error').show();
			        }
			        
			        setTimeout(function () {
				        //window.location.reload();
				        $('#flash-order-update').hide();
				        $('#flash-error').hide();
				    }, 3000);
			    },
			    error: function (jqXHR, textStatus, errorThrown)
			    {
			 		//alert('Error');
			 		$('#flash-error').show();
			        setTimeout(function () {
				        //window.location.reload();
				        $('#flash-error').hide();
				    }, 3000);
			    }
			});
			
		});
		
		
	} );
</script> -->
<script type="text/javascript">
	
	function process(id,phone){
			console.log(id);
			var id= id;

			json={
				"id":id,
				"phone":phone
			}
			var xhttp= new XMLHttpRequest();
			xhttp.open("POST", "data_order_admin_pending.php", true);
			xhttp.setRequestHeader('Content-type','application/json');
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
							<option value="pending">Pending</option>
							<option value="processing">Processing</option>
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


	
	<div style="text-align: center"><h3>Pending Orders</h3></div>
	<table id="order_admin_pending" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Order Id</th>
				<th>Customer Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Items Bought</th>
				<th>Total</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
	<?php
			
	
					$getPendingOrder=mysqli_query($con,"SELECT * FROM `paid_for_items` WHERE `status`='pending' ORDER BY `phone`");
					while($result=mysqli_fetch_assoc($getPendingOrder)){
			?>
			<tr>
		
				<td><input type="text" data-column="0" style="width:30px; border-style:none;" class="search-input-text" value="<?php echo $result['paid_id']; ?>"></td>
				<td><input type="text" data-column="1"  style="width:150px; border-style:none;" class="search-input-text" value="<?php echo $result['full_name']; ?>"></td>
				<td><input type="text" data-column="2"  style="width:150px; border-style:none;" class="search-input-text" value="<?php echo $result['email']; ?>"></td>
				<td><input type="text" data-column="3"  style="width:100px; border-style:none;" class="search-input-text"  value="<?php echo $result['phone']; ?>"></td>
				<td><input type="text" data-column="4"  class="search-input-text" value="<?php echo $result['good_details']; ?>" hidden><?php echo $result['good_details']; ?></td>
				<td><input type="text" data-column="5" style="width:50px; border-style:none;" class="search-input-text" value="<?php echo $result['total']; ?>"></td>
				<td><input type="text" data-column="6" style="width:60px; border-style:none;" class="search-input-text" value="<?php echo $result['status']; ?>"></td>
				<td><input type="button" class="search-input-text" id="processingOrder_<?php echo $result['paid_id'];?>" hidden><input type="button" data-column="4" onclick="process(<?php echo$result['paid_id']; ?>,<?php echo$result['phone']; ?>)" value="Process"></td>
			
			</tr>
			<?php }?>
	
	</table>
	<p><br><br><br><br></p>
</div>

<?php include('footer.php');?>