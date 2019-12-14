<?php
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
$user_id = $_SESSION['user_id'];
$category_sql = "SELECT * FROM `job_category`";
$cat = $db->query($category_sql);

$company_details_sql = "SELECT * FROM `company` WHERE company_id = $user_id";
$company_details = $db->query($company_details_sql);
$company_details_data = $company_details->fetch_array();

if(isset($_POST['save'])){

    $insert_data['company_id']= $user_id;
    $insert_data['job_title']="'".$_POST['job_title']."'";
    $insert_data['job_category']=$_POST['job_category'];

    if(!empty($_POST['discription'])){
        $insert_data['discription']="'".$_POST['discription']."'";
    }
    if(!empty($_POST['type'])){
        $insert_data['type']="'".$_POST['type']."'";
    }
    if(!empty($_POST['education_qualification'])){
        $insert_data['education_qualification']="'".$_POST['education_qualification']."'";
    }
    if(!empty($_POST['experience'])){
        $insert_data['experience']="'".$_POST['experience']."'";
    }
    $insert_data['job_location']="'".$_POST['job_location']."'";
    $insert_data['deadline']="'".$_POST['deadline']."'";
    $insert_data['post_date']="'".date('Y-m-d')."'";
    $insert_data['deadline']="'".$_POST['deadline']."'";
    $insert_data['vacancy']="'".$_POST['vacancy']."'";




    $columns = implode(", ",array_keys($insert_data));
    $escaped_values =array_values($insert_data);
    $values  = implode(", ", $escaped_values);
    $sql = "INSERT INTO `jobs`($columns) VALUES ($values)";
    //echo $sql;exit;
    $success = $db->query($sql);
    if($success){
        $class = 'alert-success';
        $msg = 'Save Success!!';
    }else{
        $class = 'alert-danger';
        $msg = 'Please fill up your information properly.';
    }


}


$db->close();
?>
    <div class="container">
        <div class="single">
            <?php if(empty($company_details_data)){?>
                <h3 style="color: red;">Please Submit Your Details First.</h3>
            <?php } else {?>
                <form action="" method="post" enctype="multipart/form-data">
                    <?php if(isset($msg)){?>
                        <div class="alert <?php echo $class; ?> alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <?php echo $msg;?>
                        </div>
                    <?php } ?>
                    <div class="panel panel-default">
                        <div class="panel-head text-center text-info"></div>
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="col-lg-2">Job Title<span class="text-danger">*</span></div>
                                <div class="col-lg-10">
                                    <input type="text" name="job_title" placeholder="Job Title" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">Job Category<span class="text-danger">*</span></div>
                                <div class="col-lg-10">
                                    <select name="job_category" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php while ($data = $cat->fetch_array() ){?>
                                            <option value="<?php echo $data['id'];?>"><?php echo $data['category'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">Job Details</div>
                                <div class="col-lg-10">
                                    <input type="text" name="discription" placeholder="Job Details" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">Job Type</div>
                                <div class="col-lg-10">
                                    <select name="type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">Education Requirements</div>
                                <div class="col-lg-10">
                                    <textarea class="textarea" name="education_qualification" placeholder="Education Requirements" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">Experience</div>
                                <div class="col-lg-10">
                                    <input type="text" name="experience" placeholder="Experience" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">No. Vacancy<span class="text-danger">*</span></div>
                                <div class="col-lg-10">
                                    <input type="number" name="vacancy" placeholder="No. Vacancy" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">Job Location<span class="text-danger">*</span></div>
                                <div class="col-lg-10">
                                    <input type="text" name="job_location" placeholder="Job Location" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">Application Deadline<span class="text-danger">*</span></div>
                                <div class="col-lg-10">
                                    <input type="date" name="deadline"  class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info pull-right" name="save">Post Job</button>
                </form>
                <div class="clearfix"> </div>
            <?php } ?>
        </div>
    </div>
<?php
include 'footer.php';
?>