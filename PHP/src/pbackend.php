<?php
session_start();
if((!$_SESSION['isLogin'])||(empty($_POST['problemcode'])))
header('location:practise.php');
include 'confun.php';
$no=$_POST['hidden'];
$xml = simplexml_load_file("Misc\\".$_SESSION['contestCode'].'.xml');
      $root = $xml->contest;
      $xml->formatOutput = true;  
  $result = $xml->addChild('problem');
  $result->addAttribute('problemCode',$_POST['problemcode']);
  $result->addChild('problemName',cfsc($_POST['problemname']));
  $result->addChild('problemDescription',cfsc($_POST['problemdescription']));
  $result->addChild('inputFormat',cfsc($_POST['inputformat']));
  $result->addChild('outputFormat',cfsc($_POST['outputformat']));
  $result->addChild('constraints',cfsc($_POST['constraints']));
  $result->addChild('sampleInput',cfsc($_POST['sampleinput']));
  $result->addChild('sampleOutput',cfsc($_POST['sampleoutput']));
  $link="Misc\\".$_SESSION['contestCode'].$_POST['problemcode'];
  
  $MyFile = fopen($link."sampleinput.txt", "w") or die("Unable to open file!");
    fwrite($MyFile,$_POST['sampleinput']);
    fclose($MyFile);
    $MyFile = fopen($link."sampleoutput.txt", "w") or die("Unable to open file!");
    fwrite($MyFile,$_POST['sampleoutput']);
    fclose($MyFile);
for($i=1;$i<=$no;$i++)
{
	$res=$result->addChild('TestCase');
	$MyFile = fopen($link."InputFile".$i.".txt", "w") or die("Unable to open file!");
    fwrite($MyFile,$_POST['testcaseinput'.$i]);
    fclose($MyFile);
    $MyFile = fopen($link."OutputFile".$i.".txt", "w") or die("Unable to open file!");
    fwrite($MyFile,$_POST['testcaseoutput'.$i]);
	fclose($MyFile);
	
	$res->addChild('InputFile',$link."InputFile".$i.".txt");
	$res->addChild('OutputFile',$link."OutputFile".$i.".txt");
	$res->addChild('TestCasePoints',$_POST['testcasepoints'.$i]);

  
}
$xml->asXML("Misc\\".$_SESSION['contestCode'].'.xml') or die('XML Create Error');
echo "Question has been Saved";
?>
<script src='jquery-1.12.1.js'></script>
<script type="text/javascript">
    <script type="text/javascript">
$(document).on("keydown", function (e) {
    if (e.which === 8 && !$(e.target).is("input:not([readonly]):not([type=radio]):not([type=checkbox]), textarea, [contentEditable], [contentEditable=true]")) {
        e.preventDefault();
    }
});
</script>
</script>
