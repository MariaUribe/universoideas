<?php
$result = strpos(shell_exec('/usr/local/apache/bin/apachectl -l'), 'mod_rewrite')
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Check for mod_rewrite</title></head>
<body>
<p><?php echo $result,"</p><p>mod_rewrite $result"; ?></p>
</body>
</html>