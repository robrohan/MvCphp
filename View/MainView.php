<?php $Utils = new ImplUtils(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>untitled</title>
	<meta name="author" content="Rob Rohan">
	<!-- Date: 2006-10-16 -->
</head>
<body>
	<?php print( $GLOBALS["TEST"] ); ?>
	
	<a href="<?php echo $Utils->CreateLink("Example","DoItAgain"); ?>">test</a>
	
</body>
</html>
