<?php
session_start();
unset($_SESSION['username']);

header("Location: index.php");
die(); // we always include a die after redirects.
?>