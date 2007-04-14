<div>
	<p>Oops, an error</p>
	<div>
	<?php
		$aryErrors = $GLOBALS["ERRORS"];
		
		if( count($aryErrors) ){
			foreach($aryErrors as $error){
				print($error . "<br>");
			}
		}
	?>
	<div>
<div>