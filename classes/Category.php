<?php
     
     $filepath = realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/Database.php');
     include_once ($filepath.'/../helpers/Format.php');
  
?>


<?php
  class Category
  {
            private $db;
            private $fm;

            public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
            }

            public function catInsert($catName){
            $catName = $this->fm->validation($catName);


            $catName = mysqli_real_escape_string($this->db->link,$catName);
           

            if (empty($catName)) {
                $msg = "<span class='error'>Category Field Must not be Empty</span>";
                return $msg;
              }else{
                  $query = "INSERT INTO tbl_categoryy(catName) VALUES('$catName')";
                  $catInsert = $this->db->insert($query);
                  if ($catInsert) {
                      $msg = "<span class='success'>Category Inserted Sucessfully</span>";
                      return $msg; 
                  }else{
                    $msg = "<span class='error'>Category Not Inserted</span>";
                    return $msg;
                  }
              }
            }


            public function getAllCat(){
                $query =  "SELECT * FROM tbl_categoryy ORDER BY catId DESC";
                $result =  $this->db->select($query);
                return $result;
            }


            public function getCatById($id){
                $query =  "SELECT * FROM tbl_categoryy WHERE catId = '$id'";
                $result =  $this->db->select($query);
                return $result;
            }

            public function catUpdate($catName, $id){
              $catName = $this->fm->validation($catName);
              $catName = mysqli_real_escape_string($this->db->link,$catName);
              $id = mysqli_real_escape_string($this->db->link,$id);
              if (empty($catName)) {
                $msg = "<span class='error'>Category Field Must not be Empty</span>";
                return $msg;
              }else{
                $query = "UPDATE tbl_categoryy 
                          SET catName = '$catName'
                          WHERE catId = '$id'         
                ";
                $updated_row = $this->db->update($query);
                if ($updated_row) {
                      $msg = "<span class='success'>Category Updated Sucessfully</span>";
                      return $msg;
                }else{
                    $msg = "<span class='error'>Category Not Updated</span>";
                    return $msg;
                }
              }
                
            }

           public function DelCatById($id){
                  $query =  "DELETE FROM tbl_categoryy WHERE catId = '$id'";
                  $result =  $this->db->delete($query);
                  if ($result) {
                    $msg = "<span class='success'>Category Deleted Sucessfully</span>";
                      return $msg;
                  }else {
                    $msg = "<span class='error'>Category Not Deleted</span>";
                    return $msg;
                  }

           }
  }
  
 
?>