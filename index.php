<?php 
 include 'header.php';
include 'connection.php';
global $db; $msg; $user_id;$errMSG;
//echo $current_date;exit;
$data_sql = "SELECT * FROM `job_category`;";
//echo $data_sql;exit();
$result = $db->query($data_sql);

$company_sql = "SELECT
    company.company_name,
    company.company_id,
    company.logo
    FROM
    `user`
    INNER JOIN company ON `user`.user_id = company.company_id
    WHERE
    `user`.user_level = 3";

$result2 = $db->query($company_sql);

$db->close();
?>

<style>
	.companyLogo {
		padding: 3px 3px 5px 4px;
		height: 54px;
		box-shadow: 0 1px 3px rgba(0,0,0,.35);
		border-radius: 4px;
		transition: top .2s ease-in-out,box-shadow .2s ease-in-out;
		-webkit-transition: top .2s ease-in-out,box-shadow .2s ease-in-out;
	}
	.pr {
		padding-right: 0;
	}
	.c-card.br {
		border-right: 1px solid #ddd;
	}
	.pl {
		padding-left: 0;
	}
	.companyDetails {
		padding: 0 5px 0 10px;
		position: relative;
	}
	.companyDetails ul li a {
		color: #616161;
		font-size: 12px;
		text-transform: none;
	}
	.hotJobsCompany {
		padding: 15px 0 10px;
		display: block;
	}
	.c-card {
		padding: 0 15px 20px;
	}
</style>
<div class="banner">
	<div class="container">
		<div id="search_wrapper">
		 <div id="search_form" class="clearfix">
		 <h1>Start your job search</h1>
		    <p>
                <form action="job_search_page.php" method="post">
                     <input type="text" class="text" name="category" placeholder="Enter Keyword(s)">
                     <input type="text" class="text" name="location" placeholder="Location">
                     <label class="btn2 btn-2 btn2-1b"><input type="submit" name="search" value="Find Jobs"></label>
                </form>
             </p>
            <h2 class="title">top Job Category &amp; searches</h2>
         </div>
		 <div id="city_1" class="clearfix">
			 <ul class="orange">
                 <?php $sl=1; while ($data = $result->fetch_array()){
                     if($sl < 4){?>
                         <li>
                             <a href="category_wise_job_list.php?cat=<?php echo $data['id'];?>"><?php echo $data['category'];?></a>
                         </li>
                     <?php }else{ $sl = 1;?>
                         </ul>
                         <ul class="orange">
                             <li>
                                 <a href="category_wise_job_list.php?cat=<?php echo $data['id'];?>"><?php echo $data['category'];?></a>
                             </li>
                     <?php }
                     ?>

                 <?php $sl++;} ?>
			 </ul>


	     </div>
       </div>
   </div> 
</div>	
<div class="container">
  <div class="grid_1">
	 <h3>Featured Employers</h3>
	   <ul id="flexiselDemo3">
           <?php while ($data2 = $result2->fetch_array()){?>
                  <li><a href="company_jobs_list.php?company_id=<?php echo $data2['company_id'];?>"><img src="<?php echo $data2['logo'];?>" style="max-height: 60px;min-height: 60px;max-width: 87px;min-width: 87px;" class="img-responsive" /></a></li>
            <?php }?>
	    </ul>
	    <script type="text/javascript">
		 $(window).load(function() {
			$("#flexiselDemo3").flexisel({
				visibleItems: 6,
				animationSpeed: 1000,
				autoPlay:false,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
	   </script>
	   <script type="text/javascript" src="js/jquery.flexisel.js"></script>
	 </div>

	  <div class="clearfix"> </div>
</div>
<div style="margin-bottom: 100px;"></div>
<?php 
 include 'footer.php';
?>