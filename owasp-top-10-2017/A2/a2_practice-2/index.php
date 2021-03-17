<?php
    ini_set("session.cookie_httponly", 1);
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Boik">

    <title>Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Admin</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Home</a></li>
<?php
              if ($_SESSION['username'] !== NULL) {
                echo "<li><a href=\"logout.php\">({$_SESSION['username']}) Logout</a></li>";
              } else {
                echo "<li><a href=\"/?page=login\">Login</a></li>";
                echo "<li><a href=\"/?page=register\">Register</a></li>";
              }
?>
	          </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div><!-- /.navbar -->
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Admin Panel</h1>
        <p>And "FLAG" is in here.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="/?page=admin" role="button">Go</a>
        </p>
      </div>
<?php
      define('INDEX', true);

      $allowed = array("login", "register", "admin");
      $page = (isset($_GET['page'])) ? $_GET['page'] : 'login';
      if (in_array($page, $allowed)) {
        include $page . '.php';
      }
?>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
