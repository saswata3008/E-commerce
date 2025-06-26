<?php
include("../project-config.php");
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:$admin_login_url");
}
?>