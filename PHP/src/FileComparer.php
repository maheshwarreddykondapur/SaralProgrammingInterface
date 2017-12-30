
<?php
function fileCompare($a, $b)
	{
		
		
		
		$v = rtrim(file_get_contents($b),"\x0D\x0A");
		
		$MyFile = fopen($b, "w") or die("Unable to open file!");
		
		fwrite($MyFile,$v);
		
		fclose($MyFile);
		
		
		
		
		if(filesize($a) !== filesize($b))
		return false;
		
		$ah = fopen($a, 'rb');
		
		$bh = fopen($b, 'rb');
		
		
		$result = true;
		
		while(!feof($ah))
		{
			
			if(fread($ah, 8192) != fread($bh, 8192))
			{
				
				$result = false;
				
				break;
				
			}
			
		}
		
		
		fclose($ah);
		
		fclose($bh);
		
		
		return $result;
		
	}


?>