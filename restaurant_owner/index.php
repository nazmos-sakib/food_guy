<a href="logout.php">logout</a>
<br><br><br>

<?php
   ob_start();
   session_start();

   if(isset($_SESSION['email']))
   {
   		echo '<br>Wellcome '.$_SESSION['email'];

         require('dataBase.php');

        $db = new database();

        if(!$db->check_email($_SESSION['email']))
        {
            $result = $db->extract_restaurant_detail($_SESSION['email']);

             echo "<table><tr><th>ID</th><th>Name</th></tr>";
          // output data of each row
          while($row = $result->fetch_assoc()) 
          {
              echo "<tr><td>".$row["restaurant_id"]."</td><td>".$row["restaurant_name"]."</td><td>".$row["restaurant_owner_email"]."</td><td>".$row["address"]."</td><td>".$row["city_id"]."</td></tr>";
          }
          echo "</table>";
            die();
        }
        else
        {
            $emailErr = "Email alrady exist";
        }

   }
   else
   {
   		header("location:login.php?not_succ=1");
   }

   
?>
<br><br>
