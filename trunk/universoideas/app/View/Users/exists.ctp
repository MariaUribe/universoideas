<?php 
    $exists = "0";
    $size = sizeof($user); 
    if ($size > 0)
        $exists = "1";
    
    echo '<input id="result" type="text" value="' . $exists . '">';  
?>
