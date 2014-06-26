<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Sign in page</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="validator/gen_validatorv4.js" type="text/javascript"></script>

  </head>

  <body>

    <div class="container">

      <form id="signin" name="signin" class="form-signin" role="form" method="post" action="signin.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="username" value="<?php echo $username;?>" class="form-control" placeholder="User name" pattern="[a-zA-Z0-9]{4,}" title="At least 4 letters or numbers." required autofocus>
        <input type="password" name="pwd" class="form-control" placeholder="Password" pattern=".{4,}" title="At least 4 letters or numbers." required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin-btn" onclick="validateForm();">Sign in</button>
        <div id="alert_placeholder"></div>
      </form>

    </div> <!-- /container -->

    <div id="loginWarning" class="hide">
      <strong>Warning!</strong> Please provide a valid username and password!
    </div>

    <!-- PHP form validation code -->
    <?php
      if($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $errorMessage = "";
        if(empty($_POST['username']))
          $errorMessage .="<li>Please enter a username.</li>";
        if(empty($_POST['pwd']))
          $errorMessage .= "<li>Please enter a password.</li>";

        $userName = check_input($_POST['username']);
        $userPwd = check_input($_POST['pwd']);

        if(!empty($errorMessage))
        {
          echo("<p>There was an error with your form:</p>\n");
          echo("<ul>" . $errorMessage . "</ul>\n");
        }
     /*   else
        {
          $db = mysql_connect("localhost" ,"username", "password");
          if(!$db) die("Error connecting to the MySQL database.");
          mysql_select_db("localhost", $db);
        }*/
      }

      function check_input($input)
      {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
      }
    ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>
    function validateForm()
    {
      var validator = new Validator("signin");
      validator.addValidation("username", "req", "Please enter a valid user name.");
      validator.addValidation("username", "maxlen=10", "Max length for username is 10 characters.");

      validator.addValidation("pwd", "req", "Please enter a valid password.");
      validator.addValidation("pwd", "maxlen=10", "Max length for password is 10 characters.");

      //create the default users, FOR NOW 
      var defaultUsers = [{username:"admin", password:"admin"},{username:"user", password:"user"}];

      //validate username and password
      //retrieve all the form input fields
      var formFields = document.querySelectorAll("input");
      var invalidUser = false;
      //var navigation = document.getElementById("icingaViews"); 

      //make all the validation checks for the user inputs
      for(var j = 0, length = defaultUsers.length; j<length; j++){
        if(formFields[0].value.localeCompare(defaultUsers[j].username)==0 && formFields[1].value.localeCompare(defaultUsers[j].password)==0)
          if(defaultUsers[j].username.localeCompare("admin") == 0) {
            //go to read-write permission pages
            alert('hello admin');
            document.signin.action = "admin-menu.html";
          }//if  
          else{
            //go to read only permission pages
            alert('hello user');
            document.signin.action = "user-menu.html"
          }//else 
        else
          invalidUser = true;         
      }//for
      if(invalidUser == true) {
        $(function() {
            $("#loginWarning").css('display', 'block !important');
        }); 
      }//if
      return true;
      }
    </script>
    <noscript> Your browser does not support JavaScript!</noscript>

  </body>
</html>
