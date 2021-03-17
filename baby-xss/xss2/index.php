<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>Stored XSS</title>

</head>
<body>
  <center>
  <h1>留言板<h1>
    <h2>輸入留言內容</h2>
    <form action="" method="post">
      標題: <input type="text" name="title"><br>
      內容: <textarea name="content"></textarea><br>
      <input type="submit"><br>
    </form>
    <hr>
    <?php
        $con=mysqli_connect("localhost", "root", "root", "xss");
        if (mysqli_connect_errno()) { echo "連接失敗: ".mysql_connect_error(); }
        
        if (isset($_POST['title'])) {
            $result1 = mysqli_query($con, "insert into xss(`title`, `content`) values ('".$_POST['title']."','".$_POST['content']."')");
        }
        $result2 = mysqli_query($con, "select * from xss");
        echo "<table border='1'><tr><td>標題</td><td>內容</td></tr>";
        while($row = mysqli_fetch_array($result2))
        {
            echo "<tr><td>".$row['title']."</td><td>".$row['content']."</td>";
        }
        echo "</table>";
    ?>
  </center>
</body>
</html>