<?php


function cfsc($str)
{

	$str=str_replace("\n",';..;nl;..;', $str);
	$str=str_replace("\r",'', $str);
	$str=str_replace(" ",';..;sp;..;', $str);
	$str=str_replace( '&' ,';..;amp;..;',$str);
    $str=str_replace( '<' ,';..;lt;..;',$str);
    $str=str_replace( '>' ,';..;gt;..;',$str);
    $str=str_replace( " ' " ,';..;sqt;..;',$str);
    $str=str_replace( '"' ,';..;dqt;..;',$str);
    return $str;
}
function ctsc($str)
{
	
	$str=str_replace( ';..;nl;..;',"<br/>" ,$str);
	$str=str_replace( ';..;sp;..;','&ensp;' ,$str);
	$str=str_replace( ';..;amp;..;','&' ,$str);
	$str=str_replace( ';..;lt;..;','&lt' ,$str);
	$str=str_replace( ';..;gt;..;','&gt;' ,$str);
	$str=str_replace( ';..;sqt;..;',"'" ,$str);
	$str=str_replace( ';..;dqt;..;','"' ,$str);
	return $str;
}
function ctsce($str)
{
	
	$str=str_replace( ';..;nl;..;',PHP_EOL ,$str);
	$str=str_replace( ';..;sp;..;','&ensp;' ,$str);
	$str=str_replace( ';..;amp;..;','&' ,$str);
	$str=str_replace( ';..;lt;..;','&lt' ,$str);
	$str=str_replace( ';..;gt;..;','&gt;' ,$str);
	$str=str_replace( ';..;sqt;..;',"'" ,$str);
	$str=str_replace( ';..;dqt;..;','"' ,$str);
	return $str;
}


?>