<?php
//session_start();
include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;
$user_id = $_SESSION['user_id'];

$data_sql = "SELECT * FROM student_details WHERE user_id = $user_id";
$result = $db->query($data_sql);
$user = $result->fetch_object();


$db->close();

?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo !empty($user->first_name)?$user->first_name:''?> - Curriculum Vitae</title>

<meta name="viewport" content="width=device-width"/>
<meta name="description" content=""/>
<meta charset="UTF-8"> 

<link type="text/css" rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body id="top">
<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot" class="quickFade">
			<img src="<?php echo !empty($user->user_image)?$user->user_image:'./images/headshot.jpg' ?>" alt="" />
		</div>
		
		<div id="name">
			<h1 class="quickFade delayTwo"><?php echo !empty($user->first_name)?$user->first_name:''?> <?php echo !empty($user->last_name)?$user->last_name:''?></h1>
			<h4 class="quickFade delayThree"><?php echo !empty($user->present_address)?$user->present_address:''?></h4>
		</div>
		
		<div id="contactDetails" class="quickFade delayFour">
			<ul>
				<li>email: <a href="mailto:<?php echo !empty($user->email)?$user->email:''?>" target="_blank"><?php echo !empty($user->email)?$user->email:''?></a></li>
				<li>website: <a href="<?php echo !empty($user->website)?$user->website:''?>"><?php echo !empty($user->website)?$user->website:''?></a></li>
				<li>mobile: <?php echo !empty($user->contact_number)?$user->contact_number:''?></li>
				<li>skype id: <?php echo !empty($user->skype_user_name)?$user->skype_user_name:''?></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="mainArea" class="quickFade delayFive">
		<section>
			<article>
				<div class="sectionTitle">
					<h1>CAREER OBJECTIVES</h1>
				</div>
				
				<div class="sectionContent">
					<p> <?php echo !empty($user->about)?$user->about:''?></p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
        <section>
            <div class="sectionTitle">
                <h1>Experience</h1>
            </div>

            <div class="sectionContent">
                <?php if(!empty($user->experience)){?>
                    <article>
                        <p><?php echo !empty($user->experience)?$user->experience:''?></p>
                    </article>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </section>
        <section>
            <div class="sectionTitle">
                <h1>Interest &amp; Activities</h1>
            </div>

            <div class="sectionContent">
                <?php if(!empty($user->interest_activities)){?>
                    <article>
                        <p><?php echo !empty($user->interest_activities)?$user->interest_activities:''?></p>
                    </article>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </section>
		<section>
			<div class="sectionTitle">
				<h1>ACADEMIC QUALIFICATIONS </h1>
			</div>
			
			<div class="sectionContent">
                <?php if(!empty($user->exam_1)){?>
				<article>
					<h2> <?php echo !empty($user->exam_1)?'Secondary School Certificate (SSC)':''?></h2>
					<p class="subDetails">GPA: <?php echo !empty($user->exam_1_result)?$user->exam_1_result:''?></p>
					<p>Institute: <?php echo !empty($user->exam_1_institution)?$user->exam_1_institution:''?></p>
				</article>
				<?php } ?>
				<?php if(!empty($user->exam_2)){?>
				<article>
					<h2> <?php echo !empty($user->exam_2)?'Higher Secondary Certificate (HSC)':''?></h2>
					<p class="subDetails">GPA: <?php echo !empty($user->exam_2_result)?$user->exam_2_result:''?></p>
					<p>Institute: <?php echo !empty($user->exam_2_institution)?$user->exam_2_institution:''?></p>
				</article>
				<?php } ?>
                <?php if(!empty($user->exam_3)){?>
				<article>
					<h2> <?php echo !empty($user->exam_3)?'Bachelor of Science (BSc)':''?></h2>
					<p class="subDetails">CGPA: <?php echo !empty($user->exam_3_result)?$user->exam_3_result:''?></p>
					<p>Institute: <?php echo !empty($user->exam_3_institution)?$user->exam_3_institution:''?></p>
				</article>
				<?php } ?>

			</div>
			<div class="clear"></div>
		</section>
        <section>
			<div class="sectionTitle">
				<h1>PERSONAL INFORMATION </h1>
			</div>

			<div class="sectionContent">
                <div class="col-sm-4">
                    <p>Father's Name</p>
                    <p>Mother's Name</p>
                    <p>National ID</p>
                    <p>Date of birth</p>
                    <p>Sex</p>
                    <p>Religion</p>
                    <p>Blood group</p>
                    <p>Marital Status</p>
                </div>
                <div class="col-sm-8">
                    <p><?php echo !empty($user->father_name)?$user->father_name:' &nbsp;'?></p>
                    <p><?php echo !empty($user->mother_name)?$user->mother_name:' &nbsp;'?></p>
                    <p><?php echo !empty($user->nid)?$user->nid:' &nbsp;'?></p>
                    <p><?php echo !empty($user->date_of_birth)?$user->date_of_birth:' &nbsp;'?></p>
                    <p><?php echo !empty($user->sex)?$user->sex:' &nbsp;'?></p>
                    <p><?php echo !empty($user->religion)?$user->religion:' &nbsp;'?></p>
                    <p><?php echo !empty($user->blood_group)?$user->blood_group:' &nbsp;'?></p>
                    <p><?php echo !empty($user->marital_status)?$user->marital_status:'&nbsp; '?></p>
                </div>
			</div>
			<div class="clear"></div>
		</section>
        <section>
            <div class="sectionTitle">
                <h1>Reference</h1>
            </div>

            <div class="sectionContent">
                <?php if(!empty($user->reference)){?>
                    <article>
                        <p><?php echo !empty($user->reference)?$user->reference:''?></p>
                    </article>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </section>
	</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3753241-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>