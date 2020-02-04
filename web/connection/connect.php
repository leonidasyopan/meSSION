<?php

    // default Heroku Postgres configuration URL
    $dbUrl = getenv('DATABASE_URL');

    if (empty($dbUrl)) {
    // example localhost configuration URL with postgres username and a database called cs313db
        $dbUrl = "postgres://ipnbcebnlrkyfa:a56fe8af10f5c48cc7c9d1842376f900ebdf590be3a467d41cb3785317a7a327@ec2-184-72-235-80.compute-1.amazonaws.com:5432/d3524nt5j73hmb";
    }

    $dbopts = parse_url($dbUrl);

    // print "<p>$dbUrl</p>\n\n";

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    // print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

    try {
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    }
    catch (PDOException $ex) {
        print "<p>error:" . $ex->getMessage() . "</p>\n\n";
        die();
    }

?>


