<?php







function scoreUpdater($userName,$contestCode,$questionCode,$score){
	
	include_once("MySqlClass.php");
	
	$connectionString=sqlConnection();
	
	
	
	$result=mysqli_query($connectionString,"select * from $contestCode where username='$userName' and programcode='$questionCode'");
	
	
	
	$res=mysqli_query($connectionString,"select * from $contestCode".'leaderboard'." where username='$userName'");
	
	
	
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	
	
	$row1 = mysqli_fetch_array($res,MYSQLI_ASSOC);
	
	
	
	$lscore=$row1['score'];
	
	
	
	
	
	
	if($row['score']<$score)
	{
		
	$lscore-=$row['score'];
	$lscore+=$score;
	mysqli_query($connectionString,"update $contestCode set score='$score' where username='$userName' and programcode='$questionCode'");
	//mysqli_query($connectionString,"update $contestCode set score='$pscore' where username='$userName' and programcode='$questionCode'");	
		mysqli_query($connectionString,"update $contestCode".'leaderboard'." set score='$lscore' where username='$userName'");	
	}
	
	
	
	
	
	
	

	
	
	
	
}




?>
