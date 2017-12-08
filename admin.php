<?php
session_start();   //starts or resumes a session

function loginProcess() {

    if (isset($_POST['loginForm'])) {  //checks if form has been submitted
    
        include 'database.php';
        $conn = getDatabaseConnection();
      
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            
            $sql = "SELECT *
                    FROM f_admin
                    WHERE username = :username 
                    AND   password = :password ";
            
            $namedParameters = array();
            $namedParameters[':username'] = $username;
            $namedParameters[':password'] = $password;

            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $record = $stmt->fetch();
            
            if (empty($record)) {
                
                echo "Wrong Username or password";
                
            } else {
                
               $_SESSION['username'] = $record['username'];
               $_SESSION['userName'] = $record['firstname'] . "  " . $record['lastname'];
               $_SESSION['userID'] = $record['user_id'];
               //echo $record['firstName'];
               
               header("Location: info_u.php"); //redirecting to admin.php
                
            }
           // print_r($record);
    }
}

?>

<html>

    <head>
       <meta charset=utf-8"/>
     <title> Log In </title>
     
     <link href="style.css" rel="stylesheet" type="text/css" />
     
  
    </head>
    
    <body>
    <header>
            
    <header/>
    <nav>
        <hr width= "50%" />
        <a href="index.php">Home</a>
        <a href="guest.php">Guest</a>
        <a href="admin.php">Admin Log In</a>
        <a href="new_m.php">Subscribe</a>
    </nav>
    <h1> Admin Login </h1>
            
            <form method="post">
                
                Username: <input type="text" name="username"/> <br />
                
                Password: <input type="password" name="password" /> <br />
                
                <input type="submit" name="loginForm" value="Login!"/>
                
            </form>

            <br />
            
            <?=loginProcess()?>
    
    </body>
</html>