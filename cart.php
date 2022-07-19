<?php include 'inc/header.php';?>
<?php
     if (isset($_GET['delid'])) {
		$id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delid']);
		$delCart = $ct->DelCartById($id);
	}

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
	$cartId   = $_POST['cartId'];
    $cartUpdate = $ct->CartUpdateQuantity($quantity, $cartId);
	if ($quantity<=0) {
		$delCart = $ct->DelCartById($cartId); 
	}
  }
  ?>

  <?php
     if (!isset($_GET['id'])) {
		 echo "<meta http-equiv='refresh' content='0;URL=?id=Apu'/>";
	 } 
 
 ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
					   if (isset($cartUpdate)) {
						   echo $cartUpdate;
					   }
					
					   ?>
					   <?php
					   if (isset($delCart)) {
						   echo $delCart;
					   }
					
					   ?>
						<table class="tblone">
							<tr>
						     	<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
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
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td>Tk.<?php echo $result['price'];?></td>
								<td>
									<form action="" method="post">
									<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>Tk.<?php
								$total = $result['price'] * $result['quantity'];
								echo $total;?></td>

								<td><a onclick="return confirm('Are you sure to delete!');" href="?delid=<?php echo $result['cartId'];?>">X</a></td>
							</tr>
							<?php 
							$qty = $qty +  $result['quantity'];
							$sum = $sum + $total;

							Session::set('sum',$sum);
							Session::set('qty',$qty);
							 
							 ?>
							
							<?php   } }?>
							
						</table>
						<?php
						  	$getData = $ct->CheckCartData();
							if ($getData) {
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php echo $sum;?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php
								   $vat = $sum * 0.1;
								   $gtotal = $sum + $vat;
								   echo $gtotal;
								?> </td>
							</tr>
					   </table>
					   <?php }else{
						   header("Location:index.php");
						// echo "<span style='color:green;'>Cart Is Empty ! Please Shop Now</span>";
					   }
					    ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php include 'inc/footer.php';?>