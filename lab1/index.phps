<html>
    <head>
        <title>Admin Key Panel</title>
    </head>
    <body>
        <p>Enter admin password for key</p>
        <?php
            $secret_key = '';
            extract($_GET);
            $flag = '';
            if (isset($password)) {
                if ($password === $secret_key) {
                    echo "<p>Correct!</p>";
                    echo "<p>Flag: "." $flag</p>";
                } else {
                    echo "<p>Incorrect!</p>";
                }
            }
        ?>
        <form action="#" method=”GET”>
        <p><input type="text" name="password"></p>
        <p><input type="submit" value="submit"></p>
        </form>
    </body>
</html>

