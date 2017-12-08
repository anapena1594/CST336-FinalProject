<?php

   include 'database.php'; 
   
   function shoeList() {
       
       $sql = "SELECT * from f_shoes WHERE 1"; 
       $named_parameters = array(); 
       
       if (isset($_GET['submit'])) {
           if (!empty($_GET['shoe_name'])) {
               // construct our SQL query accordingly.
               $sql .=  " AND shoe_name LIKE :shoename"; 
               $named_parameters[":shoename"] = "%" . $_GET['shoe_name'] . "%"; 
           }
           
           if (!empty($_GET['shoe_brand'])) {
               // construct our SQL query accordingly.
               $sql .=   " AND shoe_brand = '". $_GET['shoe_brand'] . "'"; 
           }
           
           if (isset($_GET['available'])) {
               // construct our SQL query accordingly.
               $sql .=   " AND shoe_availability = 'yes'"; 
           }
           
           
           
           
       
       $dbConn = getDatabaseConnection(); 
   
       
       $statement = $dbConn->prepare($sql);
       $statement->execute($named_parameters);
        
       $records = $statement->fetchAll(); 
        
       foreach ($records as $record) {
            echo "<div class='tittle'>Shoe Id: ".$record["shoe_id"]."  Shoe Name:  ".$record["shoe_name"]."  Shoe Availability:  ".$record["shoe_availability"]."</div><br>"; 
       }
   } }
   
   function shoebrand() {
        $dbConn = getDatabaseConnection(); 
        $sql = 'SELECT DISTINCT(brand_name), brand_id  FROM f_brand;'; 
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        
        $records = $statement->fetchAll(); 
        
        foreach ($records as $record) {
            echo "<option value='". $record['brand_id']. "'>". $record['brand_name']. "</option>"; 
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
        <a href="index.php">Home</a>
        <a href="guest.php">Guest</a>
        <a href="admin.php">Admin Log In</a>
        <a href="new_m.php">Subscribe</a>
        </nav>
        </br>
        <div id="Guest" > Welcome Guest! Search our Shoe Inventory!</div>
        
        <header/>
        </br>
        </br>
        </br>
          <form>
               Shoe Name: <input type="text" name="shoe_name">
               </br>
               
               Shoe Brand: 
               <select name="shoe_brand">
                     <option value=""></option>
                     <?=shoebrand()?>
               </select>
               </br>
               Available:
               <input type="checkbox" name="available">  
               
               </br>
                
               <input type="submit" value="Search" name="submit">
          </form>
          
          <?=ShoeList()?>
      </body>
  </html>