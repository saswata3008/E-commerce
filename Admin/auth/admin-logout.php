<?php
include('../../project-config.php');
session_start();
session_destroy();
header("location:$admin_login_url");
?>