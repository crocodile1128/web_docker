<!DOCTYPE>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/g/bootstrap@4.0.0-alpha.6(css/bootstrap.min.css)" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/g/jquery@3.2.1,tether@1.4.0,bootstrap@4.0.0-alpha.6,modernizr@3.3.1,detectizr@2.2.0"></script>
    <title>My Personal Site</title>
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: #111;
            color: #ccc;
            min-height: 100vh;
            background-image: radial-gradient(#111, #000);
        }
        
        h1 {
            font-size: 64px;
        }
        
        h1,
        h2,
        h3,
        h5 {
            font-weight: 300;
            color: white;
        }
        
        .btn i + span,
        .nav-link i + span {
            margin-left: 10px;
        }
        
        .btn-outline-primary {
            color: #b6e7ff !important;
        }
        
        .nav-link {
            font-size: 22px;
        }
        
        video,
        img {
            max-width: 100%;
            box-shadow: 0 0 50px black;
        }
    </style>
    <script>
        function beforeSubmit() {
            const username = document.getElementById("username").value;
            const email = document.getElementById("email").value;
            if (username === "" || email === "") {
                alert('either username or email cannot be blank');
            } else {
                $.ajax({
                    url: "user_info.php",
                    data: `username=${username}`,
                    type: "POST",
                    dataType: "text",
                    success: (msg) => {
                        const data = JSON.parse(msg);
                        document.getElementById("inputEmail").value = data.email;
                        document.getElementById("form").submit();
                    },
                    error: () =>{
                        alert('User does not exist!');
                    }
                });
            }
        }
    </script>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="text-center">
            <h1>My Personal Site</h1>
            <h5>Nice Experience to build a website by my own :)</h5>
            <h2 class="text-muted">alpha</h2>
        </div>
        <div class="d-flex flex-row mt-5 mb-5">
            <ul class="nav nav-pills flex-column mr-5" style="min-width: 200px;">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#notice" role="tab"><i class="fa fa-location-arrow"></i><span>Notice</span></a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#login" role="tab"><i class="fa fa-sign-in"></i><span>Login</span></a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fp" role="tab"><i class="fa fa-key"></i><span>Find Password</span></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="notice" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h3>Welcome to my personal site</h3>
                            <p>Be my guest. 😊</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="login" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h3>Well...</h3>
                            <p>We are sorry. Currently, it's closed.</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="fp" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <form id="form" action="send_password.php" method="POST">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                </div>
                                <input type="hidden" class="form-control" name="inputEmail" id="inputEmail">
                                </div>
                                <button type="submit" class="btn btn-primary" onclick="beforeSubmit(); return false;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>