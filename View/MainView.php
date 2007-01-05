<?php $GLOBALS["Utils"]->Trace("View::MainView: Showing main view"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>MvC PHP Example Page</title>
	<link rel="stylesheet" href="View/Style/Default.css" />
</head>
<body>
	<?php print( $GLOBALS["TEST"] ); ?>
	
	<a href="<?php echo $GLOBALS["Utils"]->CreateLink("Example","DoItAgain"); ?>">test</a>
</body>
</html>
