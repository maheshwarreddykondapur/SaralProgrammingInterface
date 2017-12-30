<?php
echo "<button onclick='test()'>Test</button>";
?>
<script type="text/javascript">
function test()
{
	alert('hey');
	<?php echo "hello"; ?>
}
</script>