
<!DOCTYPE html>
<html>
<head>
    <title>Login - Blogger</title>
    <link rel="stylesheet" href="frontend/assets/css/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<!--WRAPPER-->
<div class="wrapper">
    <div class="inner-wrapper flex fl-c">

        <div class="sign-in-wrapper flex fl-1">
            <div class="sign-in-box flex fl-c">
                <div class="sign-up-head">
                    <span><i class="fab fa-blogger-b"></i></span>
                </div>
                <form method="post">
                    <div class="sign-body">
                        <div>
                            <div class="in-div">
                                <input class="in-fo" type="email" name="email" placeholder="Email here" autocomplete="off">
                                <span class="in-span">
								<i class="fas fa-envelope"></i>
							</span>
                            </div>
                        </div>
                        <div>
                            <div class="in-div">
                                <input class="in-fo" type="password" name="password" placeholder="Password" autocomplete="off">
                                <span class="in-span">
								<i class="fas fa-lock"></i>
							</span>
                                <div>Here will be error</div>
                            </div>
                        </div>
                    </div>
                    <div class="sign-footer">
                        <button type="submit" name="login">login</button>
                        <a type="button" class="cancel-btn" href="signup.php">Sign-up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>