<td>
                <?php 
                
                 echo $result['product_id'];
                
                 ?>
                </td>
                <td>
                <?php 
               
                 echo $result['product_name'];
                
                 ?>
                </td>
                <td>
                <?php 
               
                 echo $result['product_quantity']; 
                
                 ?>
                </td>
                <td>
                <?php 
               
                 echo $result['product_price']; 
                
                 ?>
                </td>
                <td>
                    <input value="
                <?php 
                $pr=(float)$result['product_price'];
                $quant=(int)$result['product_quantity']; 
                $total=$pr*$quant;
                 echo $total; 
                
                 ?>" name="price[]">
                </td>
               <td span="2">
               <button>Drop Item</button>
               <button>Delte Item</button>
               </td>