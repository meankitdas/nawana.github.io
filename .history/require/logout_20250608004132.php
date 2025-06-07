<?php

session_start();
session_unset();
session_destroy();

header("location: /nawana.github.io/index.php");



?>
