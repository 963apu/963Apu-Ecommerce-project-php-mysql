
	<div class="header_bottom"> 
		<div class="header_bottom_left">
			<div class="section group">  
				<?php
				   $getIphone = $pd->getLatestIphone();
				   if ($getIphone) {
					   while ($result = $getIphone->fetch_assoc()) {
						  
				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['productName'];?></h2>
						<p><?php echo $fm->textShorten($result['body'],20);?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php } } ?>

			   <?php
				   $getSam = $pd->getLatestSamsung();
				   if ($getSam) {
					   while ($result = $getSam->fetch_assoc()) {
						  
				
				?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image'];?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2><?php echo $result['productName'];?></h2>
						  <p><?php echo $fm->textShorten($result['body'],20);?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
					</div>
				</div>
			</div>
			<?php } } ?>

			<div class="section group">
			<?php
				   $getAcer = $pd->getLatestAcer();
				   if ($getAcer) {
					   while ($result = $getAcer->fetch_assoc()) {
						  
				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['productName'];?></h2>
						<p><?php echo $fm->textShorten($result['body'],20);?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } } ?>	
			   <?php
				   $getCan = $pd->getLatestCanon();
				   if ($getCan) {
					   while ($result = $getCan->fetch_assoc()) {
						  
				
				?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2><?php echo $result['productName'];?></h2>
						  <p><?php echo $fm->textShorten($result['body'],20);?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
					</div>
				</div>
			</div>
			<?php } } ?>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	
