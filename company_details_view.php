<?php
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
$user_id = $_SESSION['user_id'];
$data_sql = "SELECT * FROM company WHERE company_id = $user_id";
$result = $db->query($data_sql);
$company = $result->fetch_object();
$db->close();

?>
    <div class="container">
        <div class="single">
            <div class="form-container">
                <h2>Company Profile</h2>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="name">Company Name</label>
                            <div class="col-md-9">
                                <?php echo !empty($company->company_name)?$company->company_name:''?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="Email">Email</label>
                            <div class="col-md-9">
                               <?php echo !empty($company->email)?$company->email:''?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="phone">Phone</label>
                            <div class="col-md-9">
                                <?php echo !empty($company->phone)?$company->phone:''?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="">Details</label>
                            <div class="col-md-9">
                                <?php echo !empty($company->details)?$company->details:''?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="">Address</label>
                            <div class="col-md-9">
                               <?php echo !empty($company->address)?$company->address:''?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-md-3 control-lable" for="logo">Logo</label>
                            <div class="col-md-9">
                                <img src="<?php echo !empty($company->logo)?$company->logo:'./images/headshot.jpg' ?>" alt="" />
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    </div>
<?php
include 'footer.php';
?>