<?php

session_start();
session_unset();
session_destroy();


header("location: log.php");




?>
<?php

session_start();
$_SESSION['logout'] = true;


?>