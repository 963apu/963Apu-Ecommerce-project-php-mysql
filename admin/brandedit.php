
<?php include '../classes/Brand.php';?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<?php
    if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        header("Location:brandlist.php");
    }else{

        $getid = $_GET['brandid'];
    }

    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $updateBrand = $brand->brandUpdate($brandName, $getid);
 }


?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
               <?php
                       if (isset($updateBrand)) {
                           echo $updateBrand;
                       }
                   
                   ?>



                     <?php
                     $getBrand = $brand->getBrandById($getid);
                     if ($getBrand) {
                         while ($result = $getBrand->fetch_assoc()) {
                             
                      
                   
                   ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" Value="<?php echo $result['brandName'];?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr> 
                    </form>
                    <?php } } else{
                       echo "<span class='error'>Brand Not Found</span>";   
                    }
                        ?>
                </div>
            </div>
        </div>
 


