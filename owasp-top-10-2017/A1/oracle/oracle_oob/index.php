<?php
    error_reporting(0);
    ini_set("session.cookie_httponly", 1);
    session_start();

    define('FIX', true);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Boik">

    <title>News Service</title>

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
            <a class="navbar-brand" href="index.php">News Service</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Home</a></li>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div><!-- /.navbar -->
      <!-- Main component for a primary marketing message or call to action -->
<?php
      if (isset($_GET['id'])) {
?>
      <div class="care">
        <div class="card-body">
<?php
        include "fetch_news.php";

        $result = fetch_news_from_id($_GET['id']);
        if(!defined('FIX')) {
          $row = oci_fetch_assoc($result);
?>
          <h4 class="card-title"><?= $row['TITLE']; ?></h4>
          <p class="card-text"><?= $row['CONTENT']; ?></p>
<?php
        } else {
?>
          <div class="alert alert-danger" role="alert">We're currently under construction. Sorry QQ</div>
<?php
        }
?>
          <a href="javascript:history.back()" class="card-link">??????</a>
        </div>
      </div>
<?php
      } else {
?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>??????</th>
          </tr>
        </thead>
        <tbody>
<?php
        include "fetch_news.php";

        $result = fetch_news();
        while (($row = oci_fetch_assoc($result)) !== false) {
?>
          <tr>
            <th scope="row"><?= $row['ID'] ?></th>
            <td>
              <a href="/?id=<?= $row['ID'] ?>"><?= $row['TITLE'] ?></a>
            </td>
          </tr>
<?php
        }
      }
?>
        </tbody>
      </table>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
