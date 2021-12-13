<?php
include('./config_2.php');
$query=mysqli_query($con,"SELECT * FROM stocks ORDER BY `product_name`");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Stocks</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div style="display:flex; flex-direction:column; margin:10px;">

               <input type="hidden" name="" id="stock_id" style="margin:5px;">
               <label class="col-sm-4 control-label" style="margin:5px;">Product Name</label>
                <input type="text" id="productname" placeholder="product name" style="width:200px; margin:5px;">
                <label class="col-sm-4 control-label" style="margin:5px;">Price</label>
                <input type="number" id="price" placeholder="$0.00" style="width:200px; margin:5px;">
                <label class="col-sm-4 control-label" style="margin:5px;">Quantity</label>
                <input type="number" id="quantity" placeholder="0" style="width:200px; margin:5px;">
          </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="submitEdited()">Submit</button>
      </div>
    </div>
  </div>
</div>
    <!-- Modal Ends -->
   
   <!-- Modal2 -->
<div class="modal fade" id="staticStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="./stock.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Product Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="product_name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="price"><br/>                   
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Quantity</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="quantity"><br/>                   
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Product Image</label>
                    <div class="col-sm-4">
                    <input type="file" class="form-control-file" name="image">
                    </div>
                  </div>
                 
               
                  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onClick="submit()">Record</button>
                   
      </div>
                </form>

      </div>
     
    </div>
  </div>
</div>
    <!-- Modal2 Ends -->
    <div style="display:flex; flex-direction:row;">
    <div class="col-md-4">
                <a role="button" class="btn btn-primary" data-bs-toggle="modal" onClick="newStock(<?php echo $result["stock_id"]; ?>)" data-bs-target="#staticStock"> New Stock</a> 
    </div>
        <div class="col-md-8">
            <table>
                <thead>
                <tr>
                    <td>#</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Action</td>
                </tr>    
                </thead>
                <tbody>
                <?php 
                            while($result=mysqli_fetch_assoc($query)){
                                
                    ?>
                    <tr>
                  
                    <td><?php echo $result["stock_id"];?></td>
                    <td><?php echo $result["product_name"];?></td>
                    <td><?php echo $result["quantity"];?></td>
                    <td><a href="#" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#staticBackdrop" role="button" onClick="editStock(<?php echo $result["stock_id"]; ?>)">Edit</a>
                    <a href="#" class="btn btn-default" role="button" onClick="deleteStock(<?php echo $result["stock_id"]; ?>)">Delete</a></td>
                   
                    </tr>
                    <?php }?>
                            </tbody>
            </table>
            </div>              
            </div>
           <script type="text/javascript">
                function newStock(id){
                    var ids=document.getElementById("stock_id");
                    ids.value=id;
                    console.log(ids.value);
                    
                }
                function submit(){
                    var id=document.getElementById("stock_id");
                    console.log(id.value);
                    // do AJAX connection and post to the db
                }
                
                // edit stock
                function editStock(id){
                    var editID=document.getElementById("stock_id");
                    editID.value=id;
                    // console.log("id:"+editID.value);

                }
                function submitEdited(){
                    var id=document.getElementById("stock_id");
                    var product=document.getElementById("productname").value;
                    var price=document.getElementById("price").value;
                    var quantity=document.getElementById("quantity").value;
                    const json={
                        "id":id.value,
                        "name":product,
                        "price":price,
                        "quantity":quantity
                    }
                    console.log(json)
                    // submiting to php page using AJAX
                    const xhttp = new XMLHttpRequest();

                    xhttp.open("POST",'./edit.php', true);
                    xhttp.setRequestHeader("Content-Type","application/json");
                    xhttp.send(JSON.stringify(json));
                    xhttp.onreadystatechange = function (){
                            if(xhttp.readyState === XMLHttpRequest.DONE){
                               var status=xhttp.status;
                               if(status ===0 || (status >=200 && status < 400)){
                                   console.log(xhttp.responseText);
                               }else{
                                   console.log("failed")
                               }
                                
                            }
                            }                     

                }

                function deleteStock(id){

                    
                    const json={
                        "id":id
                    }

                    const xhttp=new XMLHttpRequest();
                    xhttp.open("POST","./delete.php",true);
                    xhttp.setRequestHeader("Content-Type","application/json");
                    xhttp.send(JSON.stringify(json));
                    xhttp.onreadystatechange = function (){
                            if(xhttp.readyState === XMLHttpRequest.DONE){
                               var status=xhttp.status;
                               if(status ===0 || (status >=200 && status < 400)){
                                   console.log(xhttp.responseText);
                               }else{
                                   console.log("failed")
                               }
                                
                            }
                            } 
                }
        
           </script>
</body>
</html>