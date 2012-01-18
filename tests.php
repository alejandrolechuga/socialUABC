<?php 

    $string = '<html>
        <head>
            
        </head>
        <body>
            <img src="http://m.com/img.png">
            <div></div>
            <img src="http://m.com/img.png">
            <div></div>
            <img src="http://m.com/img.png">
            <div></div>
            <img src="http://m.com/img.png">
            <div></div>
            <div></div>
            <img src="http://m.com/img.png">
            <div></div>
            <img src="http://m.com/img.png">
            <div></div>
        </body>
    </html>';
    
    $pattern = "/\<img(.*)\>/";
    $array = array();
    $result = preg_match_all($pattern, $string, $array);
    echo "<code>";
    print_r($array);
    echo "</code>";  
   // preg_match_all ( string $pattern , string $subject [, array &$matches [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] );

?>