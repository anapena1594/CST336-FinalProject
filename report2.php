<?php
session_start();

if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

function priceavg() {
   include 'database.php'; 
  
       $sql =  "SELECT avg(Price) as a from f_shoes WHERE 1"; 
               
       
       $dbConn = getDatabaseConnection(); 
   
       
       $statement = $dbConn->prepare($sql);
       $statement->execute();
        
       $records = $statement->fetchAll(); 
        
       foreach ($records as $record) {
              echo "<div class='tittle'> Average Price:  $ ".$record["a"]."</div><br>"; 
       }
   
}
   
  ?>
  
 
<html>
      <head>
       <link href="style.css" rel="stylesheet" type="text/css" />   
      </head>
      <body>
        <header>
            
        
        <nav>
        <hr width= "50%" />
        
        <a href="info_u.php">Back</a>
        
        </nav>
        </br>
        <header>
        <h1> Average Price of all Shoes in this Boutique </h1>
        
        </header>
        <?=priceavg()?>
          
      </body>
  </html>