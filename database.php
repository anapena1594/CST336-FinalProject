<?php

function getDatabaseConnection()
{
    
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b910465920c218";
$password = "9bd5a61c";
$dbname = "heroku_b09823b21f68f71";

// Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    return $conn;
    
  }
  
 function getUsersThatMatchUserName() {
    
    $username = $_GET['username']; 

    
     $dbConn = getDatabaseConnection(); 

     $sql = "SELECT * from f_users WHERE username='$username'"; 
     
     $statement = $dbConn->prepare($sql); 
    
     $statement->execute(); 
     $records = $statement->fetchAll(); 
     echo json_encode($records); 
}




function signUp() {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $Email = $_POST['Email'];
    $username = $_POST['username']; 
    $password = $_POST['password'];
    
    
    
    $dbConn = getDatabaseConnection(); 

    $sql = "INSERT INTO f_users (firstname, lastname, username, password, Email) 
    VALUES 
    (:firstname, :lastname,:username, SHA1(:password), :Email)"; 
    
  
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(array(
        firstname =>$firstname,
        lastname => $lastname,
        username => $username, 
        password => $password,
        Email => $Email,
        
    )); 
    
    // $records = $statement->fetchAll(); 
    echo json_encode(array(
        'success' => true
    )); 
}

if ($_GET['action'] == 'validate-username' ) {
    getUsersThatMatchUserName(); 
} else if ($_POST['action'] == 'signup' ) {
    signUp(); 
}
?>

