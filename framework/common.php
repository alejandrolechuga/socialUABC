<?php 
	function __autoload($location)
	{
		if(file_exists($location)) 
		{
			require_once($location);
			return true;
		}
		else return false;
	}
	
?>