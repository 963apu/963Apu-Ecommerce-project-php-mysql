<?php
     
     $filepath = realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/Database.php');
     include_once ($filepath.'/../helpers/Format.php');
  
?> 


<?php
    class Customer
    {
        private $db;
        private $fm;

            public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
            }

            public function customerRegistration($data){
                $name = mysqli_real_escape_string($this->db->link,$data['name']);
                $address = mysqli_real_escape_string($this->db->link,$data['address']);
                $city = mysqli_real_escape_string($this->db->link,$data['city']);
                $country = mysqli_real_escape_string($this->db->link,$data['country']);
                $zip = mysqli_real_escape_string($this->db->link,$data['zip']);
                $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
                $email = mysqli_real_escape_string($this->db->link,$data['email']);
                $pass = mysqli_real_escape_string($this->db->link,md5($data['pass']));


                if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {
                    $msg = "<span style='color:red;'>Field Must not be Empty</span>";
                    return $msg;
                }

                $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
                $mailchk = $this->db->select($mailquery);
                if ($mailchk!=false) {
                    $msg = "<span style='color:red;'>Email Already Exixt</span>";
                    return $msg;                       
                }else {
                    $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,pass) VALUES('$name','$address','$city','$country','$zip','$phone','$email','$pass')";
                    $Insert_row = $this->db->insert($query);
                    if ($Insert_row) {
                        $msg = "<span style='color:green;'>Customer Data Inserted Sucessfully</span>";
                        return $msg;
                    }else{
                      $msg = "<span style='color:red;'>Customer Data Not Inserted</span>";
                      return $msg;
                    }
                }
               
            }

            public function customerLogin($data){
                $email = mysqli_real_escape_string($this->db->link,$data['email']);
                $pass = mysqli_real_escape_string($this->db->link,md5($data['pass']));
                if (empty($email) || empty($pass)) {
                    $msg = "<span style='color:red;'>Field Must not be Empty</span>";
                    return $msg;
                }

                $query = "SELECT * FROM tbl_customer WHERE email='$email' AND pass='$pass'";
                $result = $this->db->select($query);
                if ($result!=false) {
                    $value = $result->fetch_assoc();
                    Session::set("cusLogin",true);
                    Session::set("cmrId",$value['id']);
                    Session::set("cmrName",$value['name']);
                    header("Location:orderdetails.php");

                }else {
                    $msg = "<span style='color:red;'>Login Failed !</span>";
                    return $msg;
                }
  
            }

            public function getCustomerData($id){
                $query =  "SELECT * FROM tbl_customer WHERE id = '$id'";
                $result =  $this->db->select($query);
                return $result;
    
              }


              public function customerDUpdate($data,$id){
                $name = mysqli_real_escape_string($this->db->link,$data['name']);
                $address = mysqli_real_escape_string($this->db->link,$data['address']);
                $city = mysqli_real_escape_string($this->db->link,$data['city']);
                $country = mysqli_real_escape_string($this->db->link,$data['country']);
                $zip = mysqli_real_escape_string($this->db->link,$data['zip']);
                $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
                $email = mysqli_real_escape_string($this->db->link,$data['email']);
                


                if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {
                    $msg = "<span style='color:red;'>Field Must not be Empty</span>";
                    return $msg;
                   }

              else {
                    $query = "UPDATE tbl_customer 
                    SET 
                    name = '$name',
                    address = '$address',
                    country = '$country',
                    zip = '$zip',
                    phone = '$phone',
                    email = '$email',
                    city = '$city'
                    WHERE id = '$id'         
                    ";
                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                    $msg = "<span class='success'>Your Details Updated Sucessfully</span>";
                    return $msg;
                    }else{
                     $msg = "<span class='error'>Your Details Not Updated</span>";
                    return $msg;
                    }
                }
              }

            
        
    }
    

?>