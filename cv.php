<?php
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
$user_id = $_SESSION['user_id'];

if(isset($_POST['save'])){
    $delete_sql = "DELETE FROM student_details WHERE student_details.user_id = $user_id";
    $db->query($delete_sql);
    $insert_data=array();
    $insert_data['user_id']= $user_id;
    if(!empty($_POST['present_address'])){
        $insert_data['present_address']="'".$_POST['present_address']."'";

    }
    if(!empty($_POST['about'])){
        $insert_data['about']="'".$_POST['about']."'";
    }
    if(!empty($_POST['interest_activities'])){
        $insert_data['interest_activities']="'".$_POST['interest_activities']."'";
    }
    if(!empty($_POST['first_name'])){
        $insert_data['first_name']="'".$_POST['first_name']."'";
    }
    if(!empty($_POST['last_name'])){
        $insert_data['last_name']="'".$_POST['last_name']."'";
    }
    if(!empty($_POST['email'])){
        $insert_data['email']="'".$_POST['email']."'";
    }
    if(!empty($_POST['phone'])){
        $insert_data['contact_number']="'".$_POST['phone']."'";
    }
    if(!empty($_POST['website'])){
        $insert_data['website']="'".$_POST['website']."'";
    }
    if(!empty($_POST['skype'])){
        $insert_data['skype_user_name']="'".$_POST['skype']."'";
    }
    if(!empty($_POST['father_name'])){
        $insert_data['father_name']="'".$_POST['father_name']."'";
    }
    if(!empty($_POST['mother_name'])){
        $insert_data['mother_name']="'".$_POST['mother_name']."'";
    }
    if(!empty($_POST['nid'])){
        $insert_data['nid']="'".$_POST['nid']."'";
    }
    if(!empty($_POST['date_of_birth'])){
        $insert_data['date_of_birth']="'".$_POST['date_of_birth']."'";
    }
    if(!empty($_POST['sex'])){
        $insert_data['sex']="'".$_POST['sex']."'";
    }
    if(!empty($_POST['religion'])){
        $insert_data['religion']="'".$_POST['religion']."'";
    }
    if(!empty($_POST['blood_group'])){
        $insert_data['blood_group']="'".$_POST['blood_group']."'";
    }
    if(!empty($_POST['marital_status'])){
        $insert_data['marital_status']="'".$_POST['marital_status']."'";
    }
    if(!empty($_POST['experience'])){
        $insert_data['experience']="'".$_POST['experience']."'";
    }
    if(!empty($_POST['reference'])){
        $insert_data['reference']="'".$_POST['reference']."'";
    }
    if(!empty($_POST['exam_1'])){
        $insert_data['exam_1']="'".$_POST['exam_1']."'";
        $insert_data['exam_1_passing_year']=$_POST['exam_1_passing_year'];
        $insert_data['exam_1_institution']="'".$_POST['exam_1_institution']."'";
        $insert_data['exam_1_result']=$_POST['exam_1_result'];
    }
    if(!empty($_POST['exam_2'])){
        $insert_data['exam_2']="'".$_POST['exam_2']."'";
        $insert_data['exam_2_passing_year']=$_POST['exam_2_passing_year'];
        $insert_data['exam_2_institution']="'".$_POST['exam_2_institution']."'";
        $insert_data['exam_2_result']=$_POST['exam_2_result'];
    }
    if(!empty($_POST['exam_3'])){
        $insert_data['exam_3']="'".$_POST['exam_3']."'";
        $insert_data['exam_3_passing_year']=$_POST['exam_3_passing_year'];
        $insert_data['exam_3_institution']="'".$_POST['exam_3_institution']."'";
        $insert_data['exam_3_result']=$_POST['exam_3_result'];
    }
//    $target_dir = "images/user_image/";
//    $target_file = $target_dir . basename($_FILES["user_image"]["name"]);


    if(!empty($_FILES['user_image']['name'])){
        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];

        $upload_dir = 'images/user_image/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $userpic =basename($_FILES["user_image"]["name"]);".".$imgExt;

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

        $insert_data['user_image'] = "'".$upload_dir.$userpic."'";
    }


    $columns = implode(", ",array_keys($insert_data));
    $escaped_values =array_values($insert_data);
    $values  = implode(", ", $escaped_values);
    $sql = "INSERT INTO `student_details`($columns) VALUES ($values)";
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
$data_sql = "SELECT * FROM student_details WHERE user_id = $user_id";
$result = $db->query($data_sql);
$user = $result->fetch_object();

$db->close();
?>
<div class="container">
    <div class="single">
        <form action="" method="post" enctype="multipart/form-data">
            <?php if(isset($msg)){?>
                <div class="alert <?php echo $class; ?> alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $msg;?>.
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-head text-center text-info"></div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-2">Address</div>
                        <div class="col-lg-10">
                            <textarea class="textarea" name="present_address" placeholder="Present Address" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo !empty($user->present_address)?$user->present_address:''?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12"> &nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-2">Job Objectives</div>
                        <div class="col-lg-10">
                            <textarea name="about" class="form-control"><?php echo !empty($user->about)?$user->about:''?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12"> &nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-2">Interest &amp; Activities:</div>
                        <div class="col-lg-10">
                            <textarea name="interest_activities" class="form-control"><?php echo !empty($user->interest_activities)?$user->interest_activities:''?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-head text-center text-info"> </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-2">Add Experience</div>
                        <div class="col-lg-10">
                            <textarea class="textarea" name="experience" placeholder="Add Experience" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo !empty($user->experience)?$user->experience:''?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-head text-center text-info">Personal Information </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" placeholder="First Name" class="form-control" value="<?php echo !empty($user->first_name)?$user->first_name:''?>">
                        </div>
                        <div class="col-lg-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="<?php echo !empty($user->last_name)?$user->last_name:''?>">
                        </div>
                    </div>
                    <div class="col-lg-12"> &nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo !empty($user->email)?$user->email:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Phone</label>
                            <input type="text" placeholder="Phone" name="phone" class="form-control" value="<?php echo !empty($user->contact_number)?$user->contact_number:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>WebSite</label>
                            <input type="text" name="website" placeholder="Web Site" class="form-control" value="<?php echo !empty($user->website)?$user->website:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Skype</label>
                            <input type="text" name="skype" placeholder="Skype Username" class="form-control" value="<?php echo !empty($user->skype_user_name)?$user->skype_user_name:''?>">
                        </div>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <label>Father Name</label>
                            <input type="text" name="father_name" placeholder="Father Name" class="form-control" value="<?php echo !empty($user->father_name)?$user->father_name:''?>">
                        </div>
                        <div class="col-lg-6">
                            <label>Mother Name</label>
                            <input type="text" name="mother_name" placeholder="Mother Name" class="form-control" value="<?php echo !empty($user->mother_name)?$user->mother_name:''?>">
                        </div>
                    </div>
                    <div class="col-lg-12"> &nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <label>National ID</label>
                            <input type="text" name="nid" placeholder="National ID" class="form-control" value="<?php echo !empty($user->nid)?$user->nid:''?>">
                        </div>
                        <div class="col-lg-4">
                            <label>Date of Birth</label>
                            <input type="date" placeholder="Date of Birth" name="date_of_birth" class="form-control" value="<?php echo !empty($user->date_of_birth)?$user->date_of_birth:''?>">
                        </div>
                        <div class="col-lg-4">
                            <label>Sex</label>
                            <select name="sex" class="form-control">
                                <option value="">Select</option>
                                <option value="Male" <?php echo (!empty($user->sex)?(($user->sex== 'Male')?'selected':''):'');?> >Male</option>
                                <option value="Female" <?php echo (!empty($user->sex)?(($user->sex== 'Female')?'selected':''):'');?> >Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12"> &nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <label>Religion</label>
                            <input type="text" name="religion" placeholder="Religion" class="form-control" value="<?php echo !empty($user->religion)?$user->religion:''?>">
                        </div>
                        <div class="col-lg-4">
                            <label>Blood Group</label>
                            <input type="text" name="blood_group" placeholder="Blood Group" class="form-control" value="<?php echo !empty($user->blood_group)?$user->blood_group:''?>">
                        </div>
                        <div class="col-lg-4">
                            <label>Marital Status</label>
                            <select name="marital_status" class="form-control">
                                <option value="">Select</option>
                                <option value="Single" <?php echo (!empty($user->marital_status)?(($user->marital_status== 'Single')?'selected':''):'');?> >Single</option>
                                <option value="Married" <?php echo (!empty($user->marital_status)?(($user->marital_status== 'Married')?'selected':''):'');?> >Married</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-head text-center text-info">Educational Information </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label>Examination Type</label>
                            <select name="exam_1" class="form-control">
                                <option value="">Select</option>
                                <option value="SSC" <?php echo (!empty($user->exam_1)?(($user->exam_1== 'SSC')?'selected':''):'');?> >SSC</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Passing Year</label>
                            <input type="number" name="exam_1_passing_year" placeholder="Passing Year" class="form-control" value="<?php echo !empty($user->exam_1_passing_year)?$user->exam_1_passing_year:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Institution</label>
                            <input type="text" name="exam_1_institution" placeholder="Institution" class="form-control" value="<?php echo !empty($user->exam_1_institution)?$user->exam_1_institution:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Result/GPA</label>
                            <input type="text" name="exam_1_result" placeholder="Result/GPA" class="form-control" value="<?php echo !empty($user->exam_1_result)?$user->exam_1_result:''?>" >
                        </div>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label>Examination Type</label>
                            <select name="exam_2" class="form-control">
                                <option value="">Select</option>
                                <option value="HSC" <?php echo (!empty($user->exam_2)?(($user->exam_2== 'HSC')?'selected':''):'');?> >HSC</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Passing Year</label>
                            <input type="number" name="exam_2_passing_year" placeholder="Passing Year" class="form-control" value="<?php echo !empty($user->exam_2_passing_year)?$user->exam_2_passing_year:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Institution</label>
                            <input type="text" name="exam_2_institution" placeholder="Institution" class="form-control" value="<?php echo !empty($user->exam_2_institution)?$user->exam_2_institution:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Result/GPA</label>
                            <input type="text" name="exam_2_result" placeholder="Result/GPA" class="form-control" value="<?php echo !empty($user->exam_2_result)?$user->exam_2_result:''?>">
                        </div>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label>Examination Type</label>
                            <select name="exam_3" class="form-control">
                                <option value="">Select</option>
                                <option value="BSC" <?php echo (!empty($user->exam_3)?(($user->exam_3 == 'BSC')?'selected':''):'') ?> >BSC</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Passing Year</label>
                            <input type="number" name="exam_3_passing_year" placeholder="Passing Year" class="form-control" value="<?php echo !empty($user->exam_3_passing_year)?$user->exam_3_passing_year:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Institution</label>
                            <input type="text" name="exam_3_institution" placeholder="Institution" class="form-control" value="<?php echo !empty($user->exam_3_institution)?$user->exam_3_institution:''?>">
                        </div>
                        <div class="col-lg-3">
                            <label>Result/GPA</label>
                            <input type="text" name="exam_3_result" placeholder="Result/GPA" class="form-control" value="<?php echo !empty($user->exam_3_result)?$user->exam_3_result:''?>">
                        </div>
                    </div>


                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-head text-center text-info">Reference </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-2">Add Reference</div>
                        <div class="col-lg-10">
                            <textarea class="textarea" name="reference" placeholder="Add Reference" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo !empty($user->reference)?$user->reference:''?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-head text-center text-info"> </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-2">Upload Image</div>
                        <div class="col-lg-10">
                            <input class="input-group" type="file" name="user_image" accept="image/*" />
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info pull-right" name="save">Create CV</button>
        </form>
        <div class="clearfix"> </div>
    </div>
</div>
<?php
include 'footer.php';
?>