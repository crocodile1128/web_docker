<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>DOM XSS</title>
  <script type="text/javascript">
      function otter(){
          document.getElementById("name").innerHTML = document.getElementById("dom_input").value;
      }
  </script>
</head>
<body>
  <center>
  <h1>DOM XSS<h1>
	<h6 id="name">guest</h6>
    <h2>Input username</h2>
    <form action="" method="post">
      <input type="text" id="dom_input" value="Input"><br> 
      <input type="button" value="更改" onclick="otter()">
    </form>
    <hr>
    
  </center>
</body>
</html>