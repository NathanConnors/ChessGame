<?php

	/* Carry Session and Start Board */
	session_start();
	include 'chess.php';
	$validMove = new Game();
	$validMove->startpos($_SESSION['moves']);
	
	/* Sets $move to user input  */
	$move = $_POST['move'];
	
	/* Validates Move */
	$_SESSION['valid'] = $validMove->validate($move);
	
	/* Only Adds Move to Session if Valid */
	if($_SESSION['valid'] == 0)
	{
		array_push($_SESSION['moves'], $move);
		/* Execute Program */
		/* Set argument to moves */
		if(count($_SESSION['moves'] > 1))
		{
			$arg = implode(" ", $_SESSION['moves']);
		} else {
			$arg = $move;
		}
		
		// Change $stopper value to allow chess engine interaction
		// Used for testing, take out in final
		$stopper = 0;
		if($stopper !==  0){
			/* Application Location */
			$app = "..\process\ChessEngineInterface.exe";
			
			/* Search and buffer variables */
			$searchPara = "bestmove";
			$buffer = "";

			/* Opens ChessEngineInterface */
			$descr = array(
				0 => array('pipe','r'),
				1 => array('pipe','w'),
				2 => array('pipe','w')
			);

			$process = proc_open($app, $descr, $pipes);

			if (is_resource($process)) {
				fwrite($pipes[0], $arg);
				fclose($pipes[0]);
				while ($f = fgets($pipes[1])) {
					$buffer.= $f;
				}
				
				fclose($pipes[1]);
				proc_close($process);
			}

			/* Data Grabber */
			$data = explode($searchPara, $buffer);
			$dataArr = explode(" ", $data[1]);
			$engineMove = $dataArr[1];
			
			/* Add Engine Move to Game Array */
			array_push($_SESSION['moves'], $engineMove);
		}

	} 

	header('Location: ../index.php');
?>