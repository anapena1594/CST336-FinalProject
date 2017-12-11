
<html>

    <head>
       
       
       <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
          
          <script>
          function validateUsername() {
                    
            $.ajax({
                type: "get",
                url: "database.php",
                dataType: "json",
                data: {
                    'username': $('#username').val(),
                    'action': 'validate-username'
                },
                success: function(data,status) {
                    
                    if (data.length > 0) {
                        $('#username-valid').html("Username is not available"); 
                    } else {
                        $('#username-valid').html("Username is available");
                    }
                    
                  },
                complete: function(data,status) { //optional, used for debugging purposes
                     //alert(status);
                }
            });
        }
        
        function signup() {
                
                
                $.ajax({
                    type: "post",
                    url: "database.php",
                    dataType: "json",
                    data: {
                        'firstname': $('#firstname1').val(),
                        'lastname': $('#lastname1').val(),
                        'Email': $('#email1').val(),
                        'username': $('#username').val(),
                        'password': $('#password1').val(),
                        'action': 'signup'
                    },
                    success: function(data,status) {
                        alert("User added!");
                        location.reload();
                      
                      },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert("You have been added to the Admin!");
                    }
                });
                return false; 
                
            }
        
        
       </script>
     
      <title> Subscribe </title>
     
     <link href="style.css" rel="stylesheet" type="text/css" />
     
  
    </head>
    
    <body id="dummybodyid">
         <header>
            
        <header/>
    <nav>
        
        <hr width= "50%" />
        <a href="index.php">Home</a>
        <a href="guest.php">Guest</a>
        <a href="admin.php">Admin Log In</a>
        <a href="new_m.php">Subscribe</a>
    </nav>
    

   <h2> Sign Up to get Special discounts! </h2>

    <form onsubmit="return signup();">
        <fieldset>
           <legend>Sign Up</legend>
           
            First Name:  <input id='firstname1' type="text" ><br> 
            Last Name:   <input id='lastname1' type="text" ><br> 
            Email:  <input id='email1' type="text" ><br> 
            Desired Username: <input onchange="validateUsername();" id='username' type="text"> <span id="username-valid"></span></span><br>
            Password: <input id='password1' type="password"> <span id="password-valid"></span><br>
            <input type="submit" value="Sign up!">
        </fieldset>
    </form>
</body>
    
</html>