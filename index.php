<!DOCTYPE html>
<?php
require('php/chess.php');
$game = new Game();

session_start();
if(!isset($_SESSION['moves']))
{
	$_SESSION['moves'] = array();
}

if(!isset($_SESSION['valid']))
{
	$_SESSION['valid'] = 0;
}

$game->startpos($_SESSION['moves']);
?>
<html>
<head>
<title>Chess Game</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<script type='text/javascript'>
function addToForm(x)
{
	document.getElementById('movemaker').value += x;
	var lengthTest = document.getElementById('movemaker');
	if(lengthTest.value.length >= 4)
	{
		document.getElementById('moveform').submit();
	}
}
</script>
</head>

<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Chess Game</a>
			</div>
		</div><!-- /.container-fluid -->
			</nav>
		<div class='container col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2'>
	
	<form id='moveform' action='php/movement.php'style='display:none;' method='POST'>
		<input type='text' id='movemaker' name='move' placeholder='move'>
	</form>
	
<?php
/*
	foreach($_SESSION['moves'] as $key => $value)
		{
			echo $key . ": " . $value . "<br>";
		}
		*/
	$game->display($_SESSION['valid']);
 ?>
 
	<footer class="footer">
			<p class="text-muted">Nathan Connors &copy 2016</p>
	</footer>
</body>
</html>