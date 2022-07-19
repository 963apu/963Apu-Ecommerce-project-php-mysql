<?php
     
      include_once '../lib/Database.php';
      include_once '../helpers/Format.php';

?>
<?php
      class Brand{

        private $db;
        private $fm;

        public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
        }



        public function brandInsert($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link,$brandName);


            if (empty($brandName)) {
                $msg = "<span class='error'>Brand Field Must not be Empty</span>";
                return $msg;
              }else{
                  $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                  $brandInsert = $this->db->insert($query);
                  if ($brandInsert) {
                      $msg = "<span class='success'>Brand Inserted Sucessfully</span>";
                      return $msg;
                  }else{
                    $msg = "<span class='error'>Brand Name Not Inserted</span>";
                    return $msg;
                  }
              }
        }

                public function getAllBrand(){
                    $query =  "SELECT * FROM tbl_brand ORDER BY brandId DESC";
                    $result =  $this->db->select($query);
                    return $result;
                }


                public function getBrandById($getid){
                  $query =  "SELECT * FROM tbl_brand WHERE brandId = '$getid'";
                  $result =  $this->db->select($query);
                  return $result;
              }
  
              public function brandUpdate($brandName, $getid){
                $brandName = $this->fm->validation($brandName);
                $brandName = mysqli_real_escape_string($this->db->link,$brandName);
                $getid = mysqli_real_escape_string($this->db->link,$getid);
                if (empty($brandName)) {
                  $msg = "<span class='error'>Brand Name Field Must not be Empty</span>";
                  return $msg;
                }else{
                  $query = "UPDATE tbl_brand 
                            SET brandName = '$brandName'
                            WHERE brandId = '$getid'         
                  ";
                  $updated_row = $this->db->update($query);
                  if ($updated_row) {
                        $msg = "<span class='success'>Brand Name Updated Sucessfully</span>";
                        return $msg;
                  }else{
                      $msg = "<span class='error'>Brand Not Updated</span>";
                      return $msg;
                  }
                }
                  
              }

             public function  DelBrandById($id){
              $query =  "DELETE FROM tbl_brand WHERE brandId = '$id'";
              $result =  $this->db->delete($query);
              if ($result) {
                $msg = "<span class='success'>Brand Deleted Sucessfully</span>";
                  return $msg;
              }else {
                $msg = "<span class='error'>Brand Not Deleted</span>";
                return $msg;
              }
             }


      }


?>
