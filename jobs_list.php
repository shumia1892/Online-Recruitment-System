<?php
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
$current_date = date('Y-m-d');
//echo $current_date;exit;
$data_sql = "SELECT
    jobs.id, 
    company.company_name,
    jobs.job_title,
    jobs.education_qualification,
    jobs.experience,
    jobs.deadline
    FROM
    jobs
    INNER JOIN company ON jobs.company_id = company.company_id
    WHERE jobs.deadline >= '$current_date'
    ORDER BY
    jobs.id DESC";
//echo $data_sql;exit();
$result = $db->query($data_sql);

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
                <?php }  while ($data = $result->fetch_array() ){?>
                <div class="panel panel-default">
                    <div class="panel-head text-center text-info"></div>
                    <div class="panel-body" style="background: aliceblue;">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="col-lg-12"><h3><?php echo $data['company_name'];?></h3></div>
                                <div class="col-lg-12"><h4><?php echo $data['job_title'];?></h4></div>
                                <div class="col-lg-3">Education</div>
                                <div class="col-lg-9"><?php echo $data['education_qualification'];?></div>
                                <div class="col-lg-3">Experience</div>
                                <div class="col-lg-9"><?php echo $data['experience'];?></div>
                                <div class="col-lg-3">Deadline</div>
                                <div class="col-lg-9"><?php echo $data['deadline'];?></div>
                                <a class="btn btn-success pull-right" href="job_details.php?job_id=<?php echo $data['id']?>">View</a>
                            </div>
                        </div>
                        <div class="col-lg-12"> &nbsp;</div>
                    </div>
                </div>
                <?php } ?>
            </form>
            <div class="clearfix"> </div>
        </div>
    </div>
<?php
include 'footer.php';
?>