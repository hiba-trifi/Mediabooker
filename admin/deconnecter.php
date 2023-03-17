<?php 
session_start();
session_destroy();
header('location:./landing_page_admin.php')
?>