<?php
     
        $filepath = realpath(dirname(__FILE__));
        include_once ($filepath.'/../lib/Database.php');
        include_once ($filepath.'/../helpers/Format.php');
     
        
?>
<?php  
     class Product
         {
            private $db;
            private $fm;

            public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
            }


            public function productInsert($data , $file){
                $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
                $catId = mysqli_real_escape_string($this->db->link,$data['catId']);
                $brandId = mysqli_real_escape_string($this->db->link,$data['brandId']);
                $body = mysqli_real_escape_string($this->db->link,$data['body']);
                $price = mysqli_real_escape_string($this->db->link,$data['price']);
                $type = mysqli_real_escape_string($this->db->link,$data['type']);

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
            
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "uploads/".$unique_image;
                if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name== "" || $type == "") {
                    $msg = "<span class='error'>Field Must not be Empty</span>";
                     return $msg;
                }
                elseif ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!
                    </span>";
                   } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-"
                    .implode(', ', $permited)."</span>";
                   }
                   else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
                    $Insert_row = $this->db->insert($query);
                    if ($Insert_row) {
                        $msg = "<span class='success'>Product Inserted Sucessfully</span>";
                        return $msg;
                    }else{
                      $msg = "<span class='error'>Product Not Inserted</span>";
                      return $msg;
                    }
     
     
                }
               
            }


         public function getAllProduct(){
             $query = "SELECT tbl_product.*, tbl_categoryy.catName,tbl_brand.brandName 
                      FROM tbl_product
                      INNER JOIN tbl_categoryy
                      ON tbl_product.catId = tbl_categoryy.catId
                      INNER JOIN tbl_brand
                      ON tbl_product.brandId = tbl_brand.brandId
                      ORDER BY productId DESC";
             $result = $this->db->select($query);
             return $result;
         } 



         public function getProById($id){
            $query =  "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result =  $this->db->select($query);
            return $result;
        }


        public function DelProById($id){

            $query =  "DELETE FROM tbl_product WHERE productId = '$id'";
            $result =  $this->db->delete($query);
            if ($result) {
              $msg = "<span class='success'>Product Deleted Sucessfully</span>";
                return $msg;
            }else {
              $msg = "<span class='error'>Category Not Deleted</span>";
              return $msg;
            }

        }


        public function productUpdate($data , $file, $id){

                        $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
                        $catId = mysqli_real_escape_string($this->db->link,$data['catId']);
                        $brandId = mysqli_real_escape_string($this->db->link,$data['brandId']);
                        $body = mysqli_real_escape_string($this->db->link,$data['body']);
                        $price = mysqli_real_escape_string($this->db->link,$data['price']);
                        $type = mysqli_real_escape_string($this->db->link,$data['type']);

                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];
                    
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "uploads/".$unique_image;
                        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
                            $msg = "<span class='error'>Field Must not be Empty</span>";
                            return $msg;
                        } else{
                               if (!empty($file_name)) {
                                  
                             

                        if ($file_size >1048567) {
                            echo "<span class='error'>Image Size should be less then 1MB!
                            </span>";
                        } elseif (in_array($file_ext, $permited) === false) {
                            echo "<span class='error'>You can upload only:-"
                            .implode(', ', $permited)."</span>";
                        }else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = "UPDATE tbl_product 
                            SET 
                            productName = '$productName',
                            catId = '$catId',
                            brandId = '$brandId',
                            body = '$body',
                            price = '$price',
                            image = '$uploaded_image',
                            type = '$type'
                           
                            WHERE productId='$id'";
                             $updated_row = $this->db->update($query);
                            if ($updated_row) {
                                $msg = "<span class='success'>Product Updated Sucessfully</span>";
                                return $msg;
                            }else{
                            $msg = "<span class='error'>Product Not updated</span>";
                            return $msg;
                            }
            
            
                        } 

                    }else{
                        
                        $query = "UPDATE tbl_product 
                        SET 
                        productName = '$productName',
                        catId = '$catId',
                        brandId = '$brandId',
                        body = '$body',
                        price = '$price',
                        type = '$type'   
                        WHERE productId='$id'";
                         $updated_row = $this->db->update($query);
                        if ($updated_row) {
                            $msg = "<span class='success'>Product Updated Sucessfully</span>";
                            return $msg;
                        }else{
                        $msg = "<span class='error'>Product Not updated</span>";
                        return $msg;
                        }
        
        
                    } 

                    }
                }


                public function getFeatureProduct(){
                    $query =  "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 3";
                    $result =  $this->db->select($query);
                    return $result;
    

                }


                public function getNewProduct(){
                    $query =  "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
                    $result =  $this->db->select($query);
                    return $result;
                }

                public function DetailsPd($id){
                    $query = "SELECT tbl_product.*, tbl_categoryy.catName,tbl_brand.brandName 
                    FROM tbl_product
                    INNER JOIN tbl_categoryy
                    ON tbl_product.catId = tbl_categoryy.catId
                    INNER JOIN tbl_brand
                    ON tbl_product.brandId = tbl_brand.brandId
                    WHERE productId='$id'
                    ORDER BY productId DESC";
                    $result = $this->db->select($query);
                    return $result;
                }
 

                public function getLatestIphone(){
                    $query =  "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1";
                    $result =  $this->db->select($query);
                    return $result;
                 }
                 public function getLatestSamsung(){
                    $query =  "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1";
                    $result =  $this->db->select($query);
                    return $result;
                 }
                 public function getLatestAcer(){
                    $query =  "SELECT * FROM tbl_product WHERE brandId='1' ORDER BY productId DESC LIMIT 1";
                    $result =  $this->db->select($query);
                    return $result;
                 }
                 public function getLatestCanon(){
                    $query =  "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1";
                    $result =  $this->db->select($query);
                    return $result;
                 }


                 public function getprobycat($id){
                    $query =  "SELECT * FROM tbl_product WHERE catId = '$id'";
                    $id = mysqli_real_escape_string($this->db->link,$id);
                    $result =  $this->db->select($query);
                    return $result; 
                 }
               
             }
             
        

         

    
     

?>