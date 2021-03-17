<!DOCTYPE html>
    <!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
    <!--[if IE 7 ]> <html lang="en" class="no-js ie7 lt8"> <![endif]-->
    <!--[if IE 8 ]> <html lang="en" class="no-js ie8 lt8"> <![endif]-->
    <!--[if IE 9 ]> <html lang="en" class="no-js ie9"> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
        <title>Index</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css" />
    </head>
    <body>
        <div class="container">
            <form action="result.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" name="age" class="form-control" id="age" placeholder="age">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    </body>
</html>
