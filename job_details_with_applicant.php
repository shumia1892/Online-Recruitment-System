<?php
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
$user_level = $_SESSION['user_level'];
$job_id = $_GET['job_id'];
$data_sql = "SELECT
        company.company_name,
        jobs.id,
        jobs.company_id,
        jobs.job_category,
        jobs.job_title,
        jobs.discription,
        jobs.type,
        jobs.education_qualification,
        jobs.experience,
        jobs.job_location,
        jobs.post_date,
        jobs.deadline,
        jobs.vacancy,
        job_category.category,
        job_category.id as cat_id
        FROM
        jobs
        INNER JOIN company ON jobs.company_id = company.company_id
        INNER JOIN job_category ON jobs.job_category = job_category.id
        WHERE jobs.id = $job_id";
$result = $db->query($data_sql);
$data = $result->fetch_object() ;

$sql = "SELECT
        job_post.id,
        job_post.job_id,
        job_post.student_id,
        student_details.first_name,
        student_details.last_name,
        student_details.email,
        student_details.contact_number,
        skype_user_name
        FROM
        job_post
        INNER JOIN `user` ON job_post.student_id = `user`.user_id
        INNER JOIN student_details ON `user`.user_id = student_details.user_id
        WHERE
        job_post.job_id = $job_id";

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
                        <div class="col-lg-12">
                            <form method="post" action="">
                                <div class="col-lg-12">
                                    <div class="col-lg-8">
                                        <div class="col-lg-12"><h5><?php echo $data->company_name;?></h5></div>
                                        <div class="col-lg-12"><h3><?php echo $data->job_title;?></h3></div>

                                        <div class="col-lg-3"><h4>Job Details:</h4></div>
                                        <div class="col-lg-9">
                                            <p><?php echo $data->discription; ?></p>
                                        </div>
                                        <div class="col-lg-12"></div>
                                        <div class="col-lg-3"><h4>Job Nature:</h4></div>
                                        <div class="col-lg-9">
                                            <p><?php echo $data->type; ?></p>
                                        </div>
                                        <div class="col-lg-12"></div>
                                        <div class="col-lg-3"><h4>Educational Requirements:</h4></div>
                                        <div class="col-lg-9">
                                            <p><?php echo $data->education_qualification; ?></p>
                                        </div>
                                        <div class="col-lg-12"></div>
                                        <div class="col-lg-3"><h4>Experience Requirements:</h4></div>
                                        <div class="col-lg-9">
                                            <p><?php echo $data->experience; ?></p>
                                        </div>
                                        <div class="col-lg-12"></div>
                                        <div class="col-lg-3"><h4>Vacancy:</h4></div>
                                        <div class="col-lg-9">
                                            <p><?php echo $data->vacancy; ?></p>
                                        </div>
                                        <div class="col-lg-12"></div>
                                        <div class="col-lg-3"><h4>Job Location:</h4></div>
                                        <div class="col-lg-9">
                                            <p><?php echo $data->job_location; ?></p>
                                        </div>


                                    </div>
                                    <div class="col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-head text-center" style="background: yellowgreen;">Job Summery</div>
                                            <div class="panel-body">
                                                <div class="col-lg-12"><span >Published on: </span><?php $date = date_create($data->post_date); echo date_format($date,"M d, Y");?></div>
                                                <div class="col-lg-12"><span >Job Nature: </span><?php echo $data->type;?></div>
                                                <div class="col-lg-12"><span >Vacancy: </span><?php echo $data->vacancy;?></div>
                                                <div class="col-lg-12"><span >Experience: </span><?php echo $data->experience;?></div>
                                                <div class="col-lg-12"><span >Job Location: </span><?php echo $data->job_location;?></div>
                                                <div class="col-lg-12"><span >Application Deadline: </span><?php $date = date_create($data->deadline); echo date_format($date,"M d, Y");?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($user_level == 2){?>
                                    <div class="col-lg-12">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-6">
                                            <?php
                                            $student_id = $_SESSION['user_id'];
                                            $student_sql = "SELECT * FROM `job_post` WHERE student_id =$student_id  AND job_id =$job_id ";
                                            $result3 = $db->query($student_sql);
                                            $data3 = $result3->fetch_object() ;
                                            if($data3){ ?>
                                                <a class="btn btn-success text-center">Already Applied</a>
                                            <?php }else{
                                                ?>
                                                <a data-toggle="modal" data-target="#questions" class="btn btn-danger text-center">Apply</a>
                                            <?php } ?>
                                        </div>

                                    </div>
                                <?php } ?>

                            </form>
                        </div>
                        <div class="col-lg-12"> &nbsp;</div>
                    </div>
                </div>
                <?php while ( $data = $result2->fetch_array()){?>
                    <div class="panel panel-default">
                        <div class="panel-head text-center text-info"></div>
                        <div class="panel-body" style="background: aliceblue;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="col-lg-12"><h4><?php echo $data['first_name'].' '.$data['last_name'];?></h4></div>
                                    <div class="col-lg-3">Email</div>
                                    <div class="col-lg-9"><?php echo $data['email'];?></div>
                                    <div class="col-lg-3">Contact Number</div>
                                    <div class="col-lg-9"><?php echo $data['contact_number'];?></div>

                                </div>
                                <div class="col-lg-4">
                                    <a class="btn btn-success" href="view_applicant_cv.php?user_id=<?php echo $data['student_id']?>">View CV</a><br>
                                    <a class="btn btn-info " href="skype:<?php echo $data['skype_user_name'];?>?call" style="margin-top: 5px;">Start Video call</a><br>
                                </div>
                            </div>
                            <div class="col-lg-12"> &nbsp;</div>
                        </div>
                    </div>
                <?php }?>

            </form>
            <div class="modal fade" id="questions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Questions</h4>
                        </div>

                        <div class="modal-body">
                            <?php
                            $q_sql = "SELECT * FROM `question` WHERE job_category_id = $data->cat_id ORDER BY RAND() LIMIT 5";
                            $q_resulr = $db->query($q_sql); ?>
                            <form action="job_post.php" method="post">
                                <input hidden="hidden" type="number" name="job_id" value="<?php echo $job_id ?>">
                                <?php
                                $sl = 1;
                                while ($q_data = $q_resulr->fetch_array() ){?>
                                    <p style="color: teal;font-size: 16px;font-style: italic;font-weight: bold;" >Q<?php echo $sl?>: <?php echo $q_data['questions']?></p>
                                    <input hidden="hidden" type="text" name="q[]" value="<?php echo $q_data['q_id'] ?>">
                                    <?php
                                    $a = $db->query("SELECT * FROM  choice_ans WHERE choice_ans.q_id =".$q_data['q_id']);

                                    while( $an = mysqli_fetch_object($a) ) { ?>
                                        <input style="margin-left: 21px;" type="radio" name="<?php echo $an->q_id ?>" value="<?php echo $an->c_id; ?>" >
                                        <span style="color: firebrick;font-size: 15px;font-weight: bold;"><?php echo $an->choice; ?></span>
                                        <br>
                                    <?php } $sl++; }
                                ?>
                                <br>

                                <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
<?php
include 'footer.php';
?>