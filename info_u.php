<?php
session_start();

if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

   

  function ShoeList(){
  include 'database.php';
  $conn = getDatabaseConnection();
  
  $sql = "SELECT *
          FROM f_shoes order by shoe_name ASC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $records;
 }  

   
  
?>  
 
<html>
      <head>
       <link href="style.css" rel="stylesheet" type="text/css" />   
        <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete this Shoe?");
                
            }
            
        </script>
      </head>
      <body>
        <header>
            
        
        <nav>
        <hr width= "50%" />
        <a href="logout.php">Log Out</a>
        
        </nav>
        </br>
        <h2> Welcome <?=$_SESSION['userName']?>!</h2>
        
        <header/>
        </br>
        
         <h1>Please Choose a report: </h1>
         <form action="report1.php">
         <input type="submit" value="Report 1">
         </form>
         <form action="report2.php">
         <input type="submit" value="Report 2">
         </form>
         <form action="report3.php">
         <input type="submit" value="Report 3">
         </form>
         </br>
         <h1> Update or Delete Shoes in Inventory </h1>
         <?php
            
             $users = ShoeList();
             
             foreach($users as $user) {
                 
                 
                 echo "<div> ID:".$user['shoe_id'] .  "    NAME: " . $user['shoe_name'] . "    PRICE: $". $user['Price']. "</div> ";
                 
                 echo "[<a href='update.php? shoeId=".$user['shoe_id']."'> Update </a>] <br />";
                 echo "[<a onclick='return confirmDelete()' href='delete.php?shoeId=".$user['shoe_id']."'> Delete </a>] <br />";
                 
                 
                 
                 
                 
             }
             
             ?>
             
            </h4> 

      </body>
  </html>