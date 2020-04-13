<a href="logout.php">logout</a>
<br><br><br>



<?php
   ob_start();
   session_start();

   if(isset($_GET['succ_insert_item']))
   {
     echo "item inserted successfully";
   }

   if(isset($_SESSION['email']))
   {
   		echo '<br>Wellcome '.$_SESSION['email'];

         require_once('dataBase.php');

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
            //die();
        }
        
?>


  <?php
   }
   else
   {
   		header("location:login.php?not_succ=1");
   }
   
?>

<br><br>

<a href="add_food_item.php">add food item</a>

<br><br>
