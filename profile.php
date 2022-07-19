<?php include 'inc/header.php';?>
<?php
      $login = Session::get("cusLogin");
	  if ($login == false) {
		 header(Location:login.php);
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
                     <?php
		                $cmrId = Session::get("cmrId");
                      $chkOrder  = $ct->CheckOrder($cmrId);
	                   if ($chkOrder) { ?>
		                <td><a href="orderdetails.php">Your Order</a></td>

	    <?php } ?>
                  </tr>
            </table>
            <?php } }  ?>

         
				
    	
          </div>
 		</div>
 	</div>

	 <?php include 'inc/footer.php';?>