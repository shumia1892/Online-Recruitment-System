<?php 
 include 'header.php';
include 'connection.php';	
global $db; $msg;
 if(isset($_POST['reg'])){
		$user_name = $_POST['user_name'];
		$user_type = $_POST['user_type'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		
		$sql = "SELECT * FROM user WHERE username='$user_name'"; 
		$result = $db->query($sql);
		$user_ex = $result->fetch_object();
		
		if(isset($user_ex)){
			$msg = 'User Name Already Existed';
		}else{
			$sql = "INSERT INTO user (email, username, password,user_level,status)
				VALUES ('$email','$user_name', '$password', $user_type, 1)";

				if ($db->query($sql) === TRUE) {
					$msg = "New User created successfully";
				} else {
					$msg = "Error: " . $sql . "<br>" . $db->error;
				}

		}
		$db->close();
	 
		
 }
 
 
?>
<div class="container">
    <div class="single">  
	   <div class="form-container">
        <h2>Register Form</h2>
        <form method='post' action="">
		<?php if(isset($msg)){?>
		<div class="row">
			<label class="col-md-3 control-lable" for="masage"></label>
			<div class="col-md-9">
				<p class="text-danger"><?php echo $msg;?></p>
			</div>
		</div>
		
		<?php } ?>
        <div class="row">
            <div class="form-group col-md-12">
                <label class="col-md-3 control-lable" for="type">User Type</label>
                <div class="col-md-9">
                    <label class="radio-inline">
					  <input type="radio" name="user_type" value='2' required> Student
					</label>
					<label class="radio-inline">
					  <input type="radio" name="user_type" value='3' required>Company
					</label>
                </div>
            </div>
        </div>
		 <div class="row">
            <div class="form-group col-md-12">
                <label class="col-md-3 control-lable" for="email">Email</label>
                <div class="col-md-9">
                    <input type="text" path="email" name="email" id="email" class="form-control input-sm" placeholder="Email" required/>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="form-group col-md-12">
                <label class="col-md-3 control-lable" for="user_name">User Name</label>
                <div class="col-md-9">
                    <input type="text" path="user_name" name="user_name" id="user_name" class="form-control input-sm" placeholder="User Name" required/>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="form-group col-md-12">
                <label class="col-md-3 control-lable" for="password">Password</label>
                <div class="col-md-9">
                    <input type="password" path="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required/>
                </div>
            </div>
        </div>
        
        </div>
        <div class="row">
            <div class="form-actions floatRight">
                <input type="submit" name='reg' value="Register" class="btn btn-primary btn-sm">
            </div>
        </div>
    </form>
    </div>
 </div>
</div>
<?php 
 include 'footer.php';
?>