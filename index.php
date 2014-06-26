<?php
  if($_POST['signin-btn'] == "Submit")
  {
    $errorMessage = "";
    if(empty($_POST['username']))
      $errorMessage .="<li>Please enter a username.</li>";
    if(empty($_POST['pwd']))
      $errorMessage .= "<li>Please enter a password.</li>";

    $userName = $_POST['username'];
    $userPwd = $_POST['pwd'];

    if(!empty($errorMessage))
    {
      echo("<p>There was an error with your form:</p>\n");
      echo("<ul>" . $errorMessage . "</ul>\n");
    }
    else
    {
      $db = mysql_connect("localhost" ,"username", "password");
      if(!$db) die("Error connecting to the MySQL database.");
      mysql_select_db("localhost", $db);
    }
  }
?>
