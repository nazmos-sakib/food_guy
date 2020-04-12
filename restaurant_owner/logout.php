<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
	header("location:login.php?logout_succ=1"); // Redirecting To Home Page
}
?>