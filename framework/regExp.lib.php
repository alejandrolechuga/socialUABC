<?php 
	$PATTERN_LIB = array();
	$PATTERN_LIB['VARIABLE_PATTERN'] 	= "/^[A-Za-z0-9]*$/i";
	$PATTERN_LIB['EMAIL'] 				= "/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/";
	$PATTERN_LIB['EMAIL_RFC2822']		= "/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/";
	$PATTERN_LIB['PASSWORD'] 			= "/^[A-Z0-9]*$/i"; 
?>