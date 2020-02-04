<?php

    // default Heroku Postgres configuration URL
    $dbUrl = getenv('DATABASE_URL');

    if (empty($dbUrl)) {
    // example localhost configuration URL with postgres username and a database called cs313db
        $dbUrl = exec("heroku config:get DATABASE_URL -a postgresql-rigid-31826");
    }

    $dbopts = parse_url($dbUrl);

    print "<p>$dbUrl</p>\n\n";

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

    try {
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    }
    catch (PDOException $ex) {
        print "<p>error:" . $ex->getMessage() . "</p>\n\n";
        die();
    }
/*
    $dbUrl = exec("heroku config:get DATABASE_URL");

    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);


// default Heroku Postgres configuration URL
    $dbUrl = exec("heroku config:get DATABASE_URL -a postgresql-solid-49495 ");

    if (empty($dbUrl)) {
    // example localhost configuration URL with postgres username and a database called cs313db
        $dbUrl = "postgres://vyrarwggpamesp:b5158107b06cbc0eb3e43ad2932e3e9f1f9405cde04fedd740f5d668a9f38308@ec2-174-129-255-91.compute-1.amazonaws.com:5432/ddo9o8ulmium6l";
    }

    $dbopts = parse_url($dbUrl);

    print "<p>$dbUrl</p>\n\n";

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

    try {
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    }
    catch (PDOException $ex) {
        print "<p>error: " . $ex->getMessage() . " </p>\n\n";
        die();
    }

    foreach ($db->query('SELECT now()') as $row)
    {
        print "<p>$row[0]</p>\n\n";
    }

*/
?>


