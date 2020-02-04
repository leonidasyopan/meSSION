<?php 
    require "connection/connect.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>meSSION</title>
</head>
<body>
    
    <?php

        foreach ($db->query('SELECT username, password FROM users') as $row)
        {
            echo 'user: ' . $row['username'];
            echo ' password: ' . $row['password'];
            echo '<br/>';
        }

    ?>

</body>
</html>