<?php
	class Validate
	{
		private $start = "";
		private $end = "";
		
		function __construct($input)
		{
			$this->start.=$input[0];
			$this->start.=$input[1];
			
			$this->end.=$input[2];
			$this->end.=$input[3];
		}
		
	}


?>