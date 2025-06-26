<?php
include("./project-config.php");
session_start();
session_destroy();
$login_url=$cus_url."login.php/";
header("location:$login_url");
return;
?>