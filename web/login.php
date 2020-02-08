<?php include $_SERVER['DOCUMENT_ROOT'] . '/connection/server.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login/Register | meSSION</title>  
    
    <!-- This is the style for the login page -->
    <link rel="stylesheet" href="css/login-style.css" type="text/css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?> 
    </header>
    <main>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="login.php" method="POST" id="register-form">
                    <h1>Register</h1>

                    <span>Use your email to register.</span>

                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/errors/errors_register.php'; ?>

                    <fieldset>
                        <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>">
                        <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
                        <input type="password" name="password1" id="password1" placeholder="Password">
                        <input type="password" name="password2" id="password2" placeholder="Repeat Password">
                        <button type="submit" class="btn" name="reg_user">Register</button>
                    </fieldset>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="login.php" method="POST" id="login-form">
                    <h1>Login</h1>
                    
                    <span>Type your username and pasword to login.</span>
                    
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/errors/errors_login.php'; ?>

                    <fieldset>
                        <input type="text" name="username" id="username" placeholder="Username" />
                        <input type="password" name="password" id="password" placeholder="Password" />
                        <a href="enter_email.php">Forgot your password?</a>
                        <button type="submit" class="btn" name="login_user">Login</button>
                    </fieldset>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome!</h1>
                        <p>If you already have an account, click here to login.</p>
                        <button class="ghost" id="signIn">Login</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, brother or sister!</h1>
                        <p>If you still don't have an account, click here to register.</p>
                        <button class="ghost" id="signUp">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?> 
    </footer>
    
    <!-- JavaScript app para transitar entre o painel de login e o de cadastro -->
    <script src="js/login-register-switch.js"></script>

    <!-- Importing FontAwesome icons -->
    <script src="https://kit.fontawesome.com/d92ab94eeb.js"></script>

</body>
</html>