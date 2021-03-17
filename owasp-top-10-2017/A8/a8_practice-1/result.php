<?php
    ob_start();
    include('./userclass.php');
    include('./fileclasse.php');

    if (isset($_POST["submit"]) && !empty($_POST['name']) && !empty($_POST['age'])) {
        $user = new User;
        $user->name = $_POST['name'];
        $user->age = $_POST['age'];
        setcookie('cook', base64_encode(serialize($user)));
    } else if (isset($_COOKIE["cook"]) && !empty($_COOKIE["cook"])) {
        $obj = unserialize(base64_decode($_COOKIE['cook']));
        $ff = $obj->name;
    }
    if(isset($_POST["name"]) && !empty($_POST['name']) && $ff == $_POST['name']) {
?>
        <!DOCTYPE html>
            <!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
            <!--[if IE 7 ]> <html lang="en" class="no-js ie7 lt8"> <![endif]-->
            <!--[if IE 8 ]> <html lang="en" class="no-js ie8 lt8"> <![endif]-->
            <!--[if IE 9 ]> <html lang="en" class="no-js ie9"> <![endif]-->
            <!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
            <head>
                <meta charset="UTF-8" />
                <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
                <title>Result</title>
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
                    <section>
                        <div id="container_demo">
                            <div id="wrapper">
                                <div id="login" class="animate form">
                                    <h1>TEST</h1><br/><p>TEXT</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </body>
        </html>
    <?php
    } else {
        header("location: index.php");
    }
?>
