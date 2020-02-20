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

        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) { 
            array_push($errors_register, "Define a username"); 
        }
        if (empty($email)) { 
            array_push($errors_register, "Inform your email"); 
        }
        if (empty($password_1)) { 
            array_push($errors_register, "Define your password"); 
        }
        if ($password_1 != $password_2) {
            array_push($errors_register, "Passwords do not match");
        }

        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = $db->query("SELECT * FROM user_access WHERE username='$username' OR email='$email' LIMIT 1");
        if($user_check_query->rowCount() >= 1){
            array_push($errors_register, "User already registered");
        }

        if ($user['email'] === $email) {
            array_push($errors_register, "This email is already in use");
        }    

        // Finally, register user if there are no errors in the form
        if (count($errors_register) == 0) {
            // Get the hashed password.
            $hashedPassword = password_hash($password_1, PASSWORD_DEFAULT);

            $query = 'INSERT INTO user_access(username, password, email, user_create_date) VALUES(:username, :password, :email, current_timestamp)';
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            
            // **********************************************
            // NOTICE: We are submitting the hashed password!
            // **********************************************
            $statement->bindValue(':password', $hashedPassword);
            $statement->bindValue(':email', $email);            
            $statement->execute();


            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Congrats, now you're logged in.";
            header('location: index.php');
            die(); // we always include a die after redirects.
        }
    }

    // LOGIN USER
    if (isset($_POST['login_user'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if (empty($username)) {
            array_push($errors_login, "Type your username");
        }
        if (empty($password)) {
            array_push($errors_login, "Type your password");
        }

        $queryPass = 'SELECT password FROM user_access WHERE username=:username';
        
        $statement = $db->prepare($queryPass);
        $statement->bindValue(':username', $username);

        $result = $statement->execute();

        if ($result) {
            $row = $statement->fetch();
            $hashedPasswordFromDB = $row['password'];

            // now check to see if the hashed password matches
            if (password_verify($password, $hashedPasswordFromDB))
            {
                // password was correct, put the user on the session, and redirect to home
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Você está conectado";
                header('location: index.php');
                die(); // we always include a die after redirects.
            } else {
                array_push($errors_login, "User and/or password are incorrect. Try again!");
            }

        }

    }

    /*
    Accept email of user whose password is to be reset
    Send email to user to reset their password
    */
    
    if (isset($_POST['reset-password'])) {
        $email = htmlspecialchars($_POST['email']);

        // ensure that the user exists on our system
        $queryEmail = "SELECT email FROM user_access WHERE email=:email";
        $statement = $db->prepare($queryEmail);
        $statement->bindValue(':email', $email);

        $results = $statement->execute();

        if (empty($email)) {
            array_push($errors_email, "Type your email");
        } 
        /*else if($results->rowCount() <= 0) {
            array_push($errors_email, "Unfortunately, we haven't found this email in our website.");
        } */
        // generate a unique random token of length 100
        $token = bin2hex(random_bytes(50));

        if (count($errors_email) == 0) {
            // store token in the password-reset database table against the user's email
            $sql = "INSERT INTO password_resets(email, token) VALUES (:email, :token)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':token', $token, PDO::PARAM_STR);            
            $results = $stmt->execute();

            // Send email to user with the token in a link they can click on
            $to = $email;
            $subject = "Reset your passward at meSSION.";
            $msg = 'Just click the follwoing link to recover your password: <a href="https://mession.herokuapp.com/new_pass.php?token=' . $token . '">Recover password.</a>.';
            $msg = wordwrap($msg,70);
            $headers = "From: leonidasyopan@gmail.com";
            mail($to, $subject, $msg, $headers);
            header('location: pending.php?email=' . $email);
        }
    }

    // ENTER A NEW PASSWORD
    if (isset($_POST['new-password'])) {
        $new_pass = htmlspecialchars($_POST['new_password1']);
        $new_pass_c = htmlspecialchars($_POST['new_password2']);

        // Grab to token that came from the email link
        $token = $_SESSION['token'];
        if (empty($new_pass) || empty($new_pass_c)) {
            array_push($errors_reset, "Type your password.");
        }

        if ($new_pass !== $new_pass_c) {
            array_push($errors_reset, "Passwords do not match.");
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
