<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>Refected XSS</title>

</head>
<body>
  <center>
  <h1>Refected XSS<h1>
    <h2>Input</h2>
    <form action="" method="get">
      <input type="text" name="input_value" value=""><br> 
      <input type="submit">
    </form>
    <hr>
    <?php
	echo '<h2>Output</h2>';
        if (isset($_GET['input_value'])) {
            echo '<input type="text" value="' . $_GET['input_value'] . '">';
        }else {
            echo '<input type="text" value="Output">';
        }
    ?>
  </center>
</body>
</html>