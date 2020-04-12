<?php
   ob_start();
   session_start();

   if(isset($_SESSION['email']))
   {
   		echo '<br>'.$_SESSION['email'];
   }
   else
   {
   		header("location:login.php?not_succ=1");
   }

   
?>