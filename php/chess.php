<?php
	class Game
	{
		private $arr;
		
		/* Gives value to letter used for movement validations */
		private $letterVal = array(
			"a" => 1,
			"b" => 2,
			"c" => 3,
			"d" => 4,
			"e" => 5,
			"f" => 6,
			"g" => 7,
			"h" => 8
			);
		
		function __construct()
		{
		}
		
		function startpos($input)
		{
			$this->arr = array(
				"a8" => "black-rook",
				"b8" => "black-knight",
				"c8" => "black-bishop",
				"d8" => "black-queen",
				"e8" => "black-king",
				"f8" => "black-bishop",
				"g8" => "black-knight",
				"h8" => "black-rook",
				
				"a7" => "black-pawn",
				"b7" => "black-pawn",
				"c7" => "black-pawn",
				"d7" => "black-pawn",
				"e7" => "black-pawn",
				"f7" => "black-pawn",
				"g7" => "black-pawn",
				"h7" => "black-pawn",
				
				"a6" => "em",
				"b6" => "em",
				"c6" => "em",
				"d6" => "em",
				"e6" => "em",
				"f6" => "em",
				"g6" => "em",
				"h6" => "em",
				
				"a5" => "em",
				"b5" => "em",
				"c5" => "em",
				"d5" => "em",
				"e5" => "em",
				"f5" => "em",
				"g5" => "em",
				"h5" => "em",
				
				"a4" => "em",
				"b4" => "em",
				"c4" => "em",
				"d4" => "em",
				"e4" => "em",
				"f4" => "em",
				"g4" => "em",
				"h4" => "em",
				
				"a3" => "em",
				"b3" => "em",
				"c3" => "em",
				"d3" => "em",
				"e3" => "em",
				"f3" => "em",
				"g3" => "em",
				"h3" => "em",
				
				"a2" => "white-pawn",
				"b2" => "white-pawn",
				"c2" => "white-pawn",
				"d2" => "white-pawn",
				"e2" => "white-pawn",
				"f2" => "white-pawn",
				"g2" => "white-pawn",
				"h2" => "white-pawn",
				
				"a1" => "white-rook",
				"b1" => "white-knight",
				"c1" => "white-bishop",
				"d1" => "white-queen",
				"e1" => "white-king",
				"f1" => "white-bishop",
				"g1" => "white-knight",
				"h1" => "white-rook"
			);
			
			$this->moves($input);
		}
		
		/* Single Swap */
		function swap($input)
		{
			$start ="";
			$start.=$input[0];
			$start.=$input[1];
			
			$end = "";
			$end.=$input[2];
			$end.=$input[3];
			
			$temp = $this->arr[$start];
			$this->arr[$start] = "em";
			$this->arr[$end] = $temp;
		}
		
		
		/* Args Function calling $this->swap() */
		function moves($input)
		{
			for($i = 0; $i < count($input); $i++)
			{
				$this->swap($input[$i]);
			}
		}
		
		/* Printing Function, List */
		function printArray()
		{
			foreach($this->arr as $key => $value)
			{
				echo $key . ": " . $value . "<br>";
			}
		}
		
		/* Displays Board and and Array Position */
		function display($error)
		{
			$this->tableheader();
			$this->errorMessage($error);
			$newline = 0;
			$color = 0;
			foreach($this->arr as $key => $value)
			{
				$newline++;
				$color++;
				if(($color % 2) == 0){
					$this->blackSquare($key, $value);
				} else {
					$this->whiteSquare($key, $value);
				}
				if($newline == 8)
				{
					echo "</tr><tr>";
					$newline = 0;
					$color++;
				}
			}
			echo "</tr></table></div>";
		}
		
		/* Display Functions for Simple Reading */
		function tableheader()
		{
			echo "<div class='row col-md-8 col-md-offset-2'>";
			echo "<table class='table table-bordered col-md-8'>";
			//echo "<h4>Chess Game</h4>";
			echo "<form action='php/clearsession.php' method='POST'>";
			echo "<input type='submit' class='btn btn-default black-bg mybtn' value='Reset Game'>";
			echo "</form>";
		}
		
		function blackSquare($key, $value)
		{
			if($value == 'em')
			{
				echo "<td><div class='content btn btn-disabled black-bg' id=";
			} else {
				echo "<td><div class='content btn btn-default black-bg " . $value . "' id=";
			}
			echo "'" . $key . "'";
			echo "onclick=addToForm('" . $key ."')></div></td>";
		}
		
		function whiteSquare($key, $value)
		{
			if($value == 'em')
			{
				echo "<td><div class='content btn btn-disabled' id=";
			} else {
				echo "<td><div class='content btn btn-default " . $value . "' id=";
			}
			echo "'" . $key . "'";
			echo "onclick=addToForm('" . $key ."')></div></td>";
		}
		
		function errorMessage($error)
		{
			// Success
			if($error == 0)
				echo "<tr>";
			
			// Invalid Move, directional/position
			if($error == 1)
			{
				echo "<div class='alert alert-danger'>";
				echo "<strong>Invalid Move!</strong>";
				echo "</div><tr>";
			}
			
			// Requires Piece to be chosen first
			if($error == 2)
			{
				echo "<div class='alert alert-danger'>";
				echo "<strong>Click the Piece First!</strong>";
				echo "</div><tr>";
			}
			
			// Jumping Pieces
			if($error == 3)
			{
				echo "<div class='alert alert-danger'>";
				echo "<strong>You Can't Jump Pieces!</strong>";
				echo "</div><tr>";
			}
			
			// Own team in ending location
			if($error == 4)
			{
				echo "<div class='alert alert-danger'>";
				echo "<strong>Can't Kill Own Team!</strong>";
				echo "</div><tr>";
			}
			
			// Wrong Team
			if($error == 5)
			{
				echo "<div class='alert alert-danger'>";
				echo "<strong>Not Your Piece!</strong>";
				echo "</div><tr>";
			}
		}
		
		/* Returns value of square based on input */
		function checkSquare($input)
		{
			return $this->arr[$input];
		}
		
		/* Validates User Input */
		function validate($input)
		{
			$start ="";
			$start.=$input[0];
			$start.=$input[1];
			
			$end = "";
			$end.=$input[2];
			$end.=$input[3];
			
			/* Extra Variables */
			$attackcheck = explode("-", $this->arr[$end]);
			
			/* No Movement Check */
			/* Important for keeping easy session management */
			if($start == $end)
			{
				return -1;
			}
			
			/* Checks if user is using right pieces 
			if(substr($this->arr[$start], 0, 5) == "black")
			{
				return 5;
			}
			*/
			
			/* Requires Piece to be chosen first */
			if($this->arr[$start] == "em")
			{
				return 2;
			}
			
			/* Checks if moving into square that is already occupied */
			if(substr($this->arr[$end], 0, 5) == "white")
			{
				return 4;
			}
			
			/* Pawn Validation */
			if($this->arr[$start] == "white-pawn")
			{
				/* If Pawn is in starting position */
				if($start[1] == "2")
				{
					if(($this->letterVal[$start[0]] + 1) == $this->letterVal[$end[0]])
					{
						if($attackcheck[0] == "black")
						{
							return 0;
						}
						return 1;
					}
					
					if(($this->letterVal[$start[0]] - 1) == $this->letterVal[$end[0]])
					{
						if($attackcheck[0] == "black")
						{
							return 0;
						}
						return 1;
					}
					
					if((intval($end[1]) - intval($start[1])) <= 2)
						return 0;
					
					return 1;
				}
				
				/* Pawn is not in starting positions */
				if($start[1] !== "2")
				{
					if((intval($end[1]) - intval($start[1])) != 1)
						return 1;
					
					if(($this->letterVal[$start[0]] + 1) == $this->letterVal[$end[0]])
					{
						if($attackcheck[0] == "black")
						{
							return 0;
						}
						return 1;
					}
					
					if(($this->letterVal[$start[0]] - 1) == $this->letterVal[$end[0]])
					{
						if($attackcheck[0] == "black")
						{
							return 0;
						}
						return 1;
					}
					
					return 0;
				}

				/* Validates Column */
				if($start[0] !== $end[0])
				{
					return 1;
				}

				return 0;
			}
			
			/* Rook Validation */
			if($this->arr[$start] == "white-rook")
			{
				/* Fails if move is not horizontal or vertical */
				if($start[0] !== $end[0] && $start[1] !== $end[1])
				{
					return 1;
				}
				
				/* Move along number axis - vertical */
				if($start[1] !== $end[1])
				{
					$s = intval($start[1]);
					$e = intval($end[1]);
					
					if($s < $e)
					{
						// Move Up
						for($i = $s + 1; $i <= $e; $i++)
						{
							$pos = strval($i);
							$mov = $start[0];
							$mov.= $pos;
							if(substr($this->arr[$mov], 0, 5) == "white")
							{
								return 3;
							}
						}
						
					} else {
						// Move Down
						for($i = $s - 1; $i >= $e; $i--)
						{
							$pos = strval($i);
							$mov = $start[0];
							$mov.= $pos;
							if(substr($this->arr[$mov], 0, 5) == "white")
							{
								return 3;
							}
						}
					}				
					return 0;
				} // rook vertical movement end
				
				/* Move along letter axis - horizontal */
				if($start[0] !== $end[0])
				{
					$s = $this->letterVal[$start[0]];
					$e = $this->letterVal[$end[0]];
					
					if($s < $e)
					{
						// Move Right
						for($i = $s + 1; $i <= $e; $i++)
						{
							$pos = $start[1];
							$mov = array_search($i, $this->letterVal);
							$mov.= $pos;
							if(substr($this->arr[$mov], 0, 5) == "white")
							{
								return 3;
							}
						}			
					} else {
						// Move Left
						for($i = $s - 1; $i >= $e; $i--)
						{
							$pos = $start[1];
							$mov = array_search($i, $this->letterVal);
							$mov.= $pos;
							if(substr($this->arr[$mov], 0, 5) == "white")
							{
								return 3;
							}
						}
					}
					
					return  0;
				} // rook horizontal movement end
				
				return 0;
			} // rook validation end
		
			return 0;
		} // validate() end
		
	} // class Game end

?>