<?php include $_SERVER['DOCUMENT_ROOT'] . '/connection/server.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login/REgister | meSSION</title>  
    
    <!-- This is the style for the login page -->
    <link rel="stylesheet" href="css/login-style.css" type="text/css">

</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="login.php" method="POST" id="register-form">
            <h1>Criar conta</h1>
            <!-- 
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            -->
            <span>Use seu e-mail para se cadastrar</span>

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/errors/errors_register.php'; ?>

            <fieldset>
                <input type="text" name="username" id="username" placeholder="Usuário" value="<?php echo $username; ?>">
                <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $email; ?>">
                <input type="password" name="password1" id="password1" placeholder="Senha">
                <input type="password" name="password2" id="password2" placeholder="Repetir Senha">
                <button type="submit" class="btn" name="reg_user">Cadastre-se</button>
            </fieldset>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login.php" method="POST" id="login-form">
            <h1>Login</h1>
            <!-- 
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            -->
            <span>Use sua conta para fazer login</span>
            
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/errors/errors_login.php'; ?>

            <fieldset>
                <input type="text" name="username" id="username" placeholder="Usuário" />
                <input type="password" name="password" id="password" placeholder="Senha" />
                <a href="enter_email.php">Esqueceu sua senha?</a>
                <button type="submit" class="btn" name="login_user">Login</button>
            </fieldset>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Bem-vindo(a)!</h1>
				<p>Se você já tem uma conta, clique aqui para fazer seu login.</p>
				<button class="ghost" id="signIn">Login</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Olá, irmão(ã)!</h1>
				<p>Se você ainda não tem uma conta, clique aqui para fazer seu cadastro.</p>
				<button class="ghost" id="signUp">Cadastre-se</button>
			</div>
		</div>
	</div>
</div>
    
    <!-- JavaScript app para transitar entre o painel de login e o de cadastro -->
    <script src="js/login-register-switch.js"></script>

    <!-- Importing FontAwesome icons -->
    <script src="https://kit.fontawesome.com/d92ab94eeb.js"></script>

</body>
</html>