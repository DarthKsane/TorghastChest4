<?php
$rcnt = 4;
$start = 0;
/*
printf("%%b = '%b'\n", $n); // binary representation
echo str_pad($input, 10, "-=", STR_PAD_LEFT);
*/
$has = array($start);
$ln = array(1=>1, 2=>2, 4=>3, 8=>4);

function b($inte){
	global $rcnt;
	$rez = str_pad(sprintf("%b",$inte),$rcnt,"0",STR_PAD_LEFT);
	return($rez);
}

function out_array($ar){
	global $rcnt, $ln;
	echo "[[";
	for($i=1;$i<=count($ar)-1;$i++){
		//echo b($ar[$i]^$ar[$i-1])."|";
		echo $ln[($ar[$i]^$ar[$i-1])]."|";
		//echo b($ar[$i-1])."->".b($ar[$i])." (".b($ar[$i]^$ar[$i-1]).") | ";
	}
	echo "]]\n";
}

function iter($_has, $_start){
	global $rcnt;
	if(count($_has) == (1<<$rcnt)){
		//print_r($_has);
		out_array($_has);
	}else{

		$start = $_start;
		//echo str_repeat(".",count($_has)-1)."start = ".b($start)."\n";

		for ($i = 0; $i <= $rcnt-1; $i++){
			$lev = 1 << $i;
			$newstart = $_start ^ $lev;
/*			echo " [";
			foreach($_has as $item){
				echo b($item).",";
			}
			echo "] ";
			echo "lev = ".b($lev).", newstart = ".b($newstart)." \n";*/
			if(in_array($newstart,$_has)){
				//echo str_repeat(".",count($_has)-1)."dead-end = ".b($newstart)."\n";

				//тупик
			}else{
				$has = $_has;
				$has[]=$newstart;
				iter($has,$newstart);
			}
		}
	}
}

iter($has, $start);

?>
