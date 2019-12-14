
<?php
//session_start();
 include 'header.php';
include 'connection.php';	
global $db; $msg;

 if(isset($_POST['login'])){
		$user_name = $_POST['user_name'];
		$password = md5($_POST['password']);
		
		$sql = "SELECT * FROM user WHERE username='$user_name' and password = '$password' AND status= 1 ";
		$result = $db->query($sql);
		$user = $result->fetch_object();
		
		if(isset($user)){


            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['user_name'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['user_level'] = $user->user_level;
            //echo "<pre>";
            //print_r($_SESSION);
			$class = 'alert-success';
            $msg = 'Login Success!!';
            header("Location: index.php");
            exit();

		}else{
            $class = 'alert-danger';
			$msg = "Incorrect User Name or Password";
		}
		$db->close();
 }
?>
<div class="container">
    <div class="single">  
	   
	 <div class="col-md-8 single_right">
	 	   <div class="login-form-section">
                <div class="login-content">
                    <form method='post' action="">
                        <div class="section-title">
                            <h3>LogIn to your Account</h3>
							
							<?php if(isset($msg)){?>
							<div class="alert <?php echo $class; ?> alert-dismissable">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<?php echo $msg;?>.
							</div>
							<?php } ?>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                <input type="text" required="required" class="form-control" name="user_name" placeholder="Username">
                            </div>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                <input type="password" required="required" name="password" class="form-control " placeholder="Password">
                            </div>
                        </div>
					<div class="login-btn">
					   <input type="submit" name='login' value="Log in">
					</div>
					</form>
					<div class="login-bottom">
					 <div class="social-icons">
						<h4>Don't have an Account? <a href="register.php"> Register Now!</a></h4>
					 </div>
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