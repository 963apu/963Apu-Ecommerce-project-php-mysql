<?php include 'inc/header.php';?>
<?php
      $login = Session::get("cusLogin");
	  if ($login == false) {
		 header("Location:login.php");
	  }
    
?>
<?php
     if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
        $id = Session::get("cmrId");
        $insertOrder = $ct->insertCmrOrder($cmrId);
        $delcart = $ct->DeleteCustomercart();
        header("Location:success.php");
     }
     


?>
<style>
    .division{
       width: 50%;
       float:left;
    }
    .tblone{
         width:565px;
         margin:0 auto;
         border:2px solid #0CB58D;
     }
   
     .tblone tr td{
         text-align:center;

     }
     .tbltwo{
        width: 60%;
        float:right;
        text-align:left;
        border:2px solid #0CB58D;
        margin-right:14px;
        margin-top:12px;

     }
     .tbltwo tr td{
        text-align: justify;
        padding: 5px 10px; 
     }
      .ordernow{
          padding-bottom:20px;
      }
     .ordernow a{
        width:200px;
        background: #0CB58D none repeat scroll 0 0;
        color: #fff;
        font-size: 18px;
        padding: 5px;
        border-radius: 6px;
        display:block;
        text-align:center;
        margin:20px auto 0;
     }
     .ordernow a:hover{
        background: #fff;
        color:#808080;
     }

</style>

<div class="main">
   <div class="content">
       <div class="section group">
             <div class="division">
             <table class="tblone">
							<tr>
						     	<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>

							<?php
							  $getPro = $ct->getCartPro();
							  if ($getPro) {
								  $i=0;
								  $qty = 0;
								  $sum = 0;
								  while ($result = $getPro->fetch_Assoc()) {
									$i++;  
								
							
							?>
							<tr>
							    <td><?php echo $i;?></td>
								<td><?php echo $result['productName'];?></td>  
								<td>Tk. <?php echo $result['price'];?></td>
                                <td><?php echo $result['quantity'];?></td>
								<td><?php
								$total = $result['price'] * $result['quantity'];
								echo $total;?></td>
							</tr>
							<?php 
							$qty = $qty +  $result['quantity'];
							$sum = $sum + $total;
							 ?>
							
							<?php   } }?>
							
						</table>
						<?php
						  	$getData = $ct->CheckCartData();
							if ($getData) {
						?>
						<table class="tbltwo">
							<tr>
								<td>Sub Total : </td>
                                <td>:</td>
								<td>Tk. <?php echo $sum;?></td>
							</tr>
							<tr>
								<td>VAT </td>
                                <td>:</td>
								<td>10%(Tk.<?php echo $vat = $sum * 0.1;?>)</td>
							</tr>
							<tr>
								<td>Grand Total :</td>
                                <td>:</td>
								<td>Tk.<?php
								   $vat = $sum * 0.1;
								   $gtotal = $sum + $vat;
								   echo $gtotal;
								?> </td>
							</tr>
                            <tr>
								<td>Quantity </td>
                                <td>:</td>
								<td><?php echo $qty;?></td>
							</tr>
					   </table>
             </div>
             <div class="division">
             <?php 
               $id =  Session::get("cmrId");
               $getCdata = $cmr->getCustomerData($id);
               if ($getCdata ) {
                   while ($result = $getCdata->fetch_assoc()) {
                      
            
            ?>
			<table class="tblone">
            <tr>
                    
                     <td colspan="2" style="font-size:18px; font-weight: 800; color:#0CB58D;">My Profile</td>
                  </tr>
                 <tr>
                     <td width="20%">Name</td>
                     <td width="5%">:</td>
                     <td><?php echo $result['name'];?></td>
                  </tr>
                  <tr>
                     <td>phone</td>
                     <td>:</td>
                     <td><?php echo $result['phone'];?></td>
                  </tr>
                  <tr>
                     <td>Email</td>
                     <td>:</td>
                     <td><?php echo $result['email'];?></td>
                  </tr>
                  <tr>
                     <td>Address</td>
                     <td>:</td>
                     <td><?php echo $result['address'];?></td>
                  </tr>
                  <tr>
                     <td>City</td>
                     <td>:</td>
                     <td><?php echo $result['city'];?></td>
                  </tr>
                  <tr>
                     <td>Zip-Code</td>
                     <td>:</td>
                     <td><?php echo $result['zip'];?></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td><a href="editprofile.php">Update Profile Details</a></td>
                  </tr>
            </table>
            <?php } } } ?>
             </div>
       </div>

   </div>
   <div class="ordernow">
          <a href="?orderid=order">Place Your Order</a>
   </div>

</div>
<?php include 'inc/footer.php';?>