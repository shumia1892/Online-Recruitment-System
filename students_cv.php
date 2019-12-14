<?php
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
$sql = "SELECT
        student_details.user_id as student_id,
        student_details.first_name,
        student_details.last_name,
        student_details.email,
        student_details.contact_number
        FROM
        user
        INNER JOIN student_details ON `user`.user_id = student_details.user_id
        ORDER BY 
        student_details.user_id DESC";

$result2 = $db->query($sql);



//$db->close();
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
                    <div class="panel-body" style="background: aliceblue;">
                        <?php while ( $data = $result2->fetch_array()){?>
                            <div class="panel panel-default">
                                <div class="panel-head text-center text-info"></div>
                                <div class="panel-body" style="background: aliceblue;">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <div class="col-lg-12"><h4><?php echo $data['first_name'].' '.$data['last_name'];?></h4></div>
                                            <div class="col-lg-3">Email</div>
                                            <div class="col-lg-9"><?php echo $data['email'];?></div>
                                            <div class="col-lg-3">Contact Number</div>
                                            <div class="col-lg-9"><?php echo $data['contact_number'];?></div>
                                            <a class="btn btn-success pull-right" href="view_applicant_cv.php?user_id=<?php echo $data['student_id']?>">View CV</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12"> &nbsp;</div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>


            </form>

            <div class="clearfix"> </div>
        </div>
    </div>
<?php
include 'footer.php';
?>