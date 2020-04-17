<?php 
session_start();
session_destroy();
$msg = "Sessão finalizada";
header("Location: index.php?msg=$msg");
?>