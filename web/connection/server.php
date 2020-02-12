<?php
    session_start();

    // initializing variables
    $username = "";
    $email    = "";
    $errors_login = array();
    $errors_register = array();
    $errors_email = array();
    $errors_reset = array();    

    // connect to the database
    require ($_SERVER['DOCUMENT_ROOT'] . "/connection/connect.php"); 

    // REGISTER USER
    if (isset($_POST['reg_user'])) {
        // receive all input values from the form
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password_1 = htmlspecialchars($_POST['password1']);
        $password_2 = htmlspecialchars($_POST['password2']);

        // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
        date_default_timezone_set('America/Sao_Paulo');

        $user_create_date = strftime("%B %d, %Y"); // date the user was created

        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) { array_push($errors_register, "Define a username"); }
        if (empty($email)) { array_push($errors_register, "Inform your email"); }
        if (empty($password_1)) { array_push($errors_register, "Define your password"); }
        if ($password_1 != $password_2) {
        array_push($errors_register, "Passwords do not match");
        }

        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors_register, "User already registered");
        }

        if ($user['email'] === $email) {
            array_push($errors_register, "This email is already in use");
        }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors_register) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO public.users (user_id, username, password, email, user_create_date) 
                    VALUES(NEXTVAL('users_s1'), '$username', '$password', '$email', '$user_create_date')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Congrats, now you're logged in.";
        header('location: index.php');
        }
    }

    // LOGIN USER
    if (isset($_POST['login_user'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if (empty($username)) {
            array_push($errors_login, "Digite seu usuário");
        }
        if (empty($password)) {
            array_push($errors_login, "Digite sua senha");
        }

        if (count($errors_login) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Você está conectado";
                header('location: index.php');
            }else {
                array_push($errors_login, "Seu usuário e/ou senha estão incorretos");
            }
        }
    }

    /*
    Accept email of user whose password is to be reset
    Send email to user to reset their password
    */
    if (isset($_POST['reset-password'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        // ensure that the user exists on our system
        $query = "SELECT email FROM users WHERE email='$email'";
        $results = mysqli_query($db, $query);

        if (empty($email)) {
            array_push($errors_email, "Digite seu e-mail completo");
        }else if(mysqli_num_rows($results) <= 0) {
            array_push($errors_email, "Infelizmente não encontramos um usuário com esse e-mail. Cadastre-se!");
        }
        // generate a unique random token of length 100
        $token = bin2hex(random_bytes(50));

        if (count($errors_email) == 0) {
            // store token in the password-reset database table against the user's email
            $sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
            $results = mysqli_query($db, $sql);

            // Send email to user with the token in a link they can click on
            $to = $email;
            $subject = "Resete sua senha no Wardnary.com";
            $msg = 'Olá, para recuperar sua senha, basta clicar nesse link: <a href="http://wardnary.leonidasyopan.com/new_pass.php?token=' . $token . '">Recuperar senha</a>.';
            $msg = wordwrap($msg,70);
            $headers = "From: contato@leonidasyopan.com";
            mail($to, $subject, $msg, $headers);
            header('location: pending.php?email=' . $email);
        }
    }

    // ENTER A NEW PASSWORD
    if (isset($_POST['new-password'])) {
        $new_pass = mysqli_real_escape_string($db, $_POST['new_password1']);
        $new_pass_c = mysqli_real_escape_string($db, $_POST['new_password2']);

        // Grab to token that came from the email link
        $token = $_SESSION['token'];
        if (empty($new_pass) || empty($new_pass_c)) {
            array_push($errors_reset, "Digite sua nova senha.");
        }

        if ($new_pass !== $new_pass_c) {
            array_push($errors_reset, "As duas senhas não correspondem.");
        }

        if (count($errors_reset) == 0) {
            // select email address of user from the password_resets table 
            $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
            $results = mysqli_query($db, $sql);
            $email = mysqli_fetch_assoc($results)['email'];

            if ($email) {
                $new_pass = md5($new_pass);
                $sql = "UPDATE users SET password='$new_pass' WHERE email='$email'";
                $results = mysqli_query($db, $sql);
                header('location: index.php');
            } else {
                array_push($errors_reset, "Tá vindo aqui");
            }
        }
    }

?>