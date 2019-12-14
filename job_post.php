<?php
include 'header.php';
include 'connection.php';
#include 'lib/db-settings.php';
global $db; $msg; $user_id;$errMSG;

$rightAnswer = 0;
$wrongAnswer = 0;
$numberOfQuestions = 0;

//$job_id = $_GET['job_id'];
if(isset($_POST['submit'])) {
    $qIdsCSV = implode(",", $_POST['q']);
    $qry = "SELECT q_id,ans_id FROM question_ans WHERE q_id IN ($qIdsCSV)";
    $result_sql = $db->query($qry);
    $result = array();
    while ($row = $result_sql->fetch_object()) {
        $result[] = $row;
    }
    $qaRecordsArr = $result;
    $qaBook = array();
    foreach($qaRecordsArr as $record) {
        $qaBook[$record->q_id] = $record->ans_id;
    }
	//echo "<pre>";
	//print_r($_POST['q']);exit;

    foreach($_POST['q'] as $key=>$value){

        $numberOfQuestions++;

        if($_POST[$value] == $qaBook[$value] ) {
            $ansStatus = 1;
            $rightAnswer++;
        } else{
            $ansStatus = 0;
            $wrongAnswer++;
        }
    }

    if($rightAnswer >= 4){
        $student_id = $_SESSION['user_id'];
        $job_id = $_POST['job_id'];
        $sql = "INSERT INTO job_post (job_id,student_id) VALUE ($job_id,$student_id)";
        $result_sql2 = $db->query($sql);
        $class = "alert-success";
        $msg = 'Congratulation!! You are qualified for this job. We will contact with you later.';

    }else{
        $class = "alert-danger";
        $msg = 'Sorry!! You are not Qualified for this job. ';
    }

    //echo $rightAnswer;
    ?>
    <div class="container">
        <div class="single">
            <div class="panel panel-default">
                <div class="panel-head text-center text-info"></div>
                <div class="panel-body" style="background: aliceblue;">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <div class="alert <?php echo $class; ?>">
                                <?php echo $msg;?>.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-8"><h4>Total Questions:</h4></div>
                            <div class="col-lg-4"><p><?php echo $numberOfQuestions;?></p></div>

                            <div class="col-lg-12"></div>
                            <div class="col-lg-8"><h4>Number of Right Answer for Qualify:</h4></div>
                            <div class="col-lg-4"><p>4</p></div>

                            <div class="col-lg-12"></div>
                            <div class="col-lg-8"><h4>Right Answer:</h4></div>
                            <div class="col-lg-4"><p><?php echo $rightAnswer;?></p></div>

                            <div class="col-lg-12"></div>
                            <div class="col-lg-8"><h4>Wrong Answer:</h4></div>
                            <div class="col-lg-4"><p><?php echo $wrongAnswer;?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'footer.php';
}