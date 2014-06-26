<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href=assets/ico/favicon.ico">

    <title>Icinga-view</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="view.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Icinga views</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">


    </div><!-- /.container -->

  <?php
    // we connect to the icinga_configuration database
    $link = mysqli_connect('srv-c2f41-26-10', 'ro', 'ro', 'icinga_configuration') or die("Error connecting to DB " . mysqli_error($link));

    //select all the contact groups we have 
    $query = "SELECT FK_CCG_CName FROM ContactContactGroup";
    $contacts = mysqli_query($link,$query);

    if(!$contacts) {
    die("Invalid query: " . mysqli_error());
    }

    while($contact = mysqli_fetch_array($contacts))
    {
      echo $contact[0] . " ----contact";
      echo "<br>";
      $contactGroups = mysqli_query($link, "SELECT FK_CCG_CGName FROM ContactContactGroup WHERE FK_CCG_CName = '$contact[0]'");

      if(!$contactGroups) {
        die("Invalid query: " . mysqli_error());
      }
      while($group = mysqli_fetch_array($contactGroups))
      {
        echo $group[0] . " ----group name";
        echo "<br>";
        $services = mysqli_query($link, "SELECT FK_CGS_SName FROM ContactGroupService WHERE FK_CGS_CGName = '$group[0]'");
        if(!$services) {
          die("Invalid query: " . mysqli_error());
        }//if
        while($service = mysqli_fetch_array($services))
        {
          echo $service[0] . " ----service";
          echo "<br>";
        }//while  
      }//while
    }//while

    mysqli_close($link);
  ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
