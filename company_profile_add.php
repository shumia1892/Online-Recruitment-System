<?php
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
$user_id = $_SESSION['user_id'];
if(isset($_POST['save'])){
    $delete_sql = "DELETE FROM company WHERE company_id = $user_id";
    $db->query($delete_sql);
    $insert_data=array();
    $insert_data['company_id']= $user_id;
    $insert_data['company_name'] = "'".$_POST['company_name']."'";
    $insert_data['email'] = "'".$_POST['email']."'";
    $insert_data['phone'] = "'".$_POST['phone']."'";

    if(!empty($_POST['details'])){
        $insert_data['details']="'".$_POST['details']."'";
    }
    if(!empty($_POST['address'])){
        $insert_data['address']="'".$_POST['address']."'";
    }
    if(!empty($_FILES['logo'])){
        $imgFile = $_FILES['logo']['name'];
        $tmp_dir = $_FILES['logo']['tmp_name'];
        $imgSize = $_FILES['logo']['size'];

        $upload_dir = 'images/company/logo/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $userpic =basename($_FILES["logo"]["name"]);".".$imgExt;

//        echo $userpic;
//        exit;

        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){
            // Check file size '5MB'
            if($imgSize < 5000000)    {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else{
                $errMSG = "Sorry, your file is too large.";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
//        echo $userpic;
//        exit();

        $insert_data['logo'] = "'".$upload_dir.$userpic."'";
    }
    $columns = implode(", ",array_keys($insert_data));
    $escaped_values =array_values($insert_data);
    $values  = implode(", ", $escaped_values);
    $sql = "INSERT INTO `company`($columns) VALUES ($values)";
    //echo $sql;exit;
    $success = $db->query($sql);
    if($success){
        $class = 'alert-success';
        $msg = 'Save Success!!';
    }else{
        $class = 'alert-danger';
        if($errMSG){
            $msg = $errMSG;
        }else{
            $msg = 'Please fill up your information properly.';
        }

    }

}

$data_sql = "SELECT * FROM company WHERE company_id = $user_id";
$result = $db->query($data_sql);
$company = $result->fetch_object();
$db->close();

?>
    <div class="container">
        <div class="single">
            <div class="form-container">
                <h2>Company Profile</h2>
                <form method='post' action="" enctype="multipart/form-data">
                    <?php if(isset($msg)){?>
                        <div class="row">
                            <label class="col-md-3 control-lable" for="masage"></label>
                            <div class="col-md-9">
                                <p class="<?php echo $class;?>"><?php echo $msg;?></p>
                            </div>
                        </div>

                    <?php } ?>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="name">Company Name</label>
                            <div class="col-md-9">
                                <input type="text" path="name" name="company_name" id="company_name" class="form-control input-sm" placeholder="Company Name" value="<?php echo !empty($company->company_name)?$company->company_name:''?>" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="Email">Email</label>
                            <div class="col-md-9">
                                <input type="email" path="email" name="email" id="email" class="form-control input-sm" placeholder="Email" value="<?php echo !empty($company->email)?$company->email:''?>" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="phone">Phone</label>
                            <div class="col-md-9">
                                <input type="text" path="phone" name="phone" id="phone" class="form-control input-sm" placeholder="Phone" value="<?php echo !empty($company->phone)?$company->phone:''?>" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="">Details</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="details" ><?php echo !empty($company->details)?$company->details:''?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="">Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="address" ><?php echo !empty($company->address)?$company->address:''?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="logo">Logo</label>
                            <div class="col-md-9">
                                <input class="input-group" type="file" name="logo" accept="image/*" />
                            </div>
                        </div>
                    </div>

            </div>
            <div class="row">
                <div class="form-actions floatRight">
                    <input type="submit" name='save' value="Save" class="btn btn-primary btn-sm">
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
<?php
include 'footer.php';
?>