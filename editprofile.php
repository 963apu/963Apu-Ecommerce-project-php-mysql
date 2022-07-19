<?php include 'inc/header.php';?>
<?php
      $login = Session::get("cusLogin");
	  if ($login == false) {
		 header(Location:login.php);
	  }
    
?>
<?php
			  $id = Session::get("cmrId");		  
			  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
			   $customerDupdate = $cmr->customerDUpdate($_POST,$id);
				   }
?>
 <style>
     .tblone{
         width:550px;
         margin:0 auto;
         border:2px solid #0CB58D;
     }
     .tblone tr td{
         text-align:justify;
     }
 </style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <?php 
               $id =  Session::get("cmrId");
               $getCdata = $cmr->getCustomerData($id);
               if ($getCdata ) {
                   while ($result = $getCdata->fetch_assoc()) {
                      
            
            ?>
            <form action="" method="post">
			<table class="tblone">
                <?php 
                   if (isset($customerDupdate)) {
                     echo " <tr><td colspan='5' style='font-size:18px; font-weight: 800; color:#0CB58D;'>".$customerDupdate."</td></tr>";
                   }
                ?>
                <tr>
                     <td colspan="2" style="font-size:18px; font-weight: 800; color:#0CB58D;">My Profile</td>
                  </tr>
                 <tr>
                     <td width="20%">Name</td>
                     <td width="5%">:</td>
                     <td><input type="text" name="name" value="<?php echo $result['name'];?>"></td>
                  </tr>
                  <tr>
                     <td>phone</td>
                     <td>:</td>
                     <td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td>
                  </tr>
                  <tr>
                     <td>Email</td>
                     <td>:</td>
                     <td><input type="text" name="email" value="<?php echo $result['email'];?>"></td>
                  </tr>
                  <tr>
                     <td>Address</td>
                     <td>:</td>
                     <td><input type="text" name="address" value="<?php echo $result['address'];?>"></td>
                  </tr>
                  <tr>
                     <td>City</td>
                     <td>:</td>
                     <td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
                  </tr>
                  <tr>
                     <td>Zip-Code</td>
                     <td>:</td>
                     <td><input type="text" name="zip" value="<?php echo $result['zip'];?>"></td>
                  </tr>
                  <tr>
                     <td>Country</td>
                     <td>:</td>
                     <td><input type="text" name="country" value="<?php echo $result['country'];?>"></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td><input type="submit" name="submit" value="Save"></td>
                  </tr>
            </table>
            </form>
            <?php } }  ?>
				
          </div>
 		</div>
 	</div>

	 <?php include 'inc/footer.php';?>