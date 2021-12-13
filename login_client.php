<?php

include("./admin/layout.php");
include("./admin/config.php");
session_start();
?>

<div class="container"><br><br>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="panel panel-default">
		    <div class="panel-body">
			    <h2 align="center">Track Your Order</h2>
			    <?php
			    	if(isset($_SESSION['new_profile'])){
			    		echo "<h4 style='color:green'>Profile has been created successfully!</h4><br>";
			    		session_unset();
			    	}  
			    ?>
			    <form method="POST">
				    <div class="form-group">
				    	<label for="user">Email:</label>
				    	<input type="text" class="form-control" id="user" name="email">
				    </div>
				    <div class="form-group">
				    	<label for="pass">Phone:</label>
				    	<input type="password" class="form-control" id="pass" name="phone">
				    </div>
			    	<!-- <button type="submit" class="btn btn-default">Submit</button><br><br> -->

			    	<div class="row">
			    		<div class="col-md-4">
			    			<button type="submit" class="btn btn-primary">Login</button>
			    		</div>
			    	</div>

			    	<?php 
			    		if(isset($_POST['email']) && isset($_POST['phone']) ){
			    			//echo "<h3>Invalid username or password</h3>";
			    			$stmt = $conn->prepare("SELECT `email`,`phone` FROM `paid_for_items`  where email=? and phone=?");
			    			$stmt->bindParam(1, $_POST['email']);
							$stmt->bindParam(2, $_POST['phone']);
							$stmt->execute();
							$row = $stmt->fetch();
							if($row!=null){
								//session_start();
								$_SESSION['email'] = $row['email'];

								if(isset($_SESSION['email'])){

									header('location: client_track_delivery.php');
                                    $_SESSION['email'] = $row['email'];
								}else{
									echo "<script type='text/javascript'>
                                            alert('You haven't placed an order as yet!!')
                                            window.location('login_client.php')
                                          </script>";
								}
								
							}else{
								echo"Invalid username or password!";
							}
			    		} 
			    		
			    	?>
				</form>
		    </div>
		</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>

<?php 
	include('./admin/footer.php')
?>