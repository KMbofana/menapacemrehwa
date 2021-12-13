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

<!-- data-target="#modal_product_add" -->
<script type='text/javascript'>
	function seeItems(id,goods){

		function setAttributes(el, attrs){
			// looping according to the number of attributes to be set
			for(var key in attrs){
				el.setAttribute(key,attrs[key]);
				
			}
		}

		var seeItems=document.getElementById('seeProduct_'+id);
		setAttributes(seeItems,{"data-toggle":"modal","data-target":"#modal_product_add"})

		const newArray=goods.split("and").sort()
		console.log(newArray);

		// console.log(newArray.length);
		for(var i=0; i<=newArray.length; i++){

			var table=document.getElementById('example');
			var row=table.insertRow(0)
			var cell=row.insertCell(0)

			cell.innerHTML = newArray[i]
			// prod.value=newArray[i];
		}
	}
//  data-toggle="modal" data-target="#modal_product_add"
	function sendEmail(id,email){

		function setAttributs(elm, attri){

			for(var key in attri){
				elm.setAttribute(key,attri[key]);
			}
		}

		var sendMail=document.getElementById('sendemail_'+id)
		setAttributs(sendMail,{ "data-toggle":"modal", "data-target":"#modal_email"})

		var client_email=document.getElementById('email');
		client_email.value=email;

	}

</script>

		
<?php
	include('link_bootstrap.php'); 
?>
		
		
<div class="container">

	<!-- Modal1 -->
	<div id="modal_product_add" class="modal fade " role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal  for Add Product-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Items Delivered</h4>
	      </div>
	      <div class="modal-body">
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example"></table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
		

<!-- Modal 2 Email-->
<div id="modal_email" class="modal fade " role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal  for Add Product-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Inform Client Through Email That Goods Have Been Delivered</h4>
	      </div>
	      <div class="modal-body">
	        <form method="POST" action="../emails/contactbuyer.php">
	        	<div class="form-group" hidden>
			    	<label>Product Id:</label>
			    	<input type="text" class="form-control" id="p_id" name="id">
			    </div>
	        	<div class="form-group">
			    	<label>Email</label>
			    	<input type="text" class="form-control" id="email" name="email" readonly>
			    </div>
			    <div class="form-group">
			    	<label>Message</label>
			    	<textarea type="text" class="form-control" id="p_brand" name="message"></textarea>
			    </div>
			   
				<div class="modal-footer">
	      	<input type="submit" id="add_product" class="btn btn-success" value="Send Email"></button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	      </div>
			   
	        </form>
	      </div>
	     
	    </div>

	  </div>
	</div>




	<div style="text-align: center"><h3>Delivered Orders</h3></div>
	<table id="order_admin_delivered" class="table table-striped table-bordered">
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
			
	
			$getPendingOrder=mysqli_query($con,"SELECT * FROM `paid_for_items` WHERE `status`='items delivered' ORDER BY `phone`");
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
				<input type="button" style="margin:5px;" data-column="5"class="search-input-text" id="seeProduct_<?php echo $result['paid_id'];?>" value="See Items" onclick="seeItems(<?php echo $result['paid_id'];?>,'<?php echo $result['good_details'];?>')">
				<input type="button" style="margin:5px;" data-column="6" id="sendemail_<?php echo $result['paid_id'];?>" value="Send Email" onclick="sendEmail(<?php echo $result['paid_id']; ?>,'<?php echo $result['email']; ?>')">
			</div>
		</td>
	
	</tr>
	<?php }?>
	</table>
	<p><br><br><br><br></p>
	<div align="right">
		<button id="add_product" class="btn btn-info" data-toggle="modal" data-target="#modal_product_add">Add Product</button>
	</div>
</div>

<?php include('footer.php')?>