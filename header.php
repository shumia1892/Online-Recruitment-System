<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
<title>Campus</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seeking Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.simple.timer.js"></script>


<script src="js/bootstrap.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!----font-Awesome----->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!----font-Awesome----->
</head>
<body style="background-color: darkseagreen;">
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="index.php" style="color: ghostwhite;">Online <br>Campus Recruitment System</a>
	    </div>
	    <!--/.navbar-header-->
	    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
	        <ul class="nav navbar-nav">
                <li class="btn btn-success btn-sm" style="margin-right: 3px;"><a href="jobs_list.php">Job List</a></li>
                <li class="btn btn-success btn-sm" style="margin-right: 3px;"><a href="students_cv.php">Students CV</a></li>
		        <?php if(isset($_SESSION['user_id'])){?>
                    <?php if($_SESSION['user_level'] == 3 ){?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobs<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="jobs.php">Post Job</a></li>
                                <li><a href="view_company_job_post.php">View Jobs</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user_name'];?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if($_SESSION['user_level'] == 2 ){?>
                                <li><a href="cv.php">Edit Resume</a></li>
                                <li><a href="view_cv.php">View Resume</a></li>
                            <?php }else{ ?>
                                <li><a href="company_details_view.php">View Profile</a></li>
                                <li><a href="company_profile_add.php">Edit Profile</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else{?>
		            <li class="btn btn-success btn-sm" style="margin-right: 3px;"><a href="login.php">Login</a></li>
                    <li class="btn btn-success btn-sm" style="margin-right: 3px;"><a href="register.php">Registration</a></li>
                    <li class="btn btn-success btn-sm"><a href="admin">Admin</a></li>
                <?php } ?>
	        </ul>
	    </div>
	    <div class="clearfix"> </div>
	  </div>
	    <!--/.navbar-collapse-->
	</nav>