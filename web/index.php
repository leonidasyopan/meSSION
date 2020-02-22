<?php 
    // Start the session
    session_start();
        require "connection/connect.php"; 

    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>meSSION</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?> 
    </header>
    <main>
        <section  class="content-width">

            <section class="welcome-message">
                <h2>What about finding a Missionary from your past?</h2>

                <p>Have you been loking for a missionary who served with you or in your area, but you can't quite remember his/her name or any other useful information?</p>

                <p>Fear no more! <span class="mession-in-paragraph">meSSION</span> will help you find "your" missionary based on the area and/or time he served his mission.</p>

                <p><em>Give the search box a try!</em></p>

            </section>

            <figure class="top-banner">
                <img src="img/missionary-montage.png" alt="Missionaries">
            </figure>

            <?php
                if (isset($_SESSION['username'])) {

            ?>
            <div class="search-box">            

                <form method="post" action="index.php">
                    <input type="text" name="query" placeholder="Search information...">
                    <select name="typeOfQuery">
                        <option value="">Select Filter</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="missionary_title">Missionary Title</option>
                        <option value="unit_name">Ward/Branch</option>
                    </select>
                    <input type="submit" name="submit" value="Find">
                </form>
            </div>
            <?php
                }
            ?>
            <div class="search-result">
                <?php
                    if(isset($_POST['submit'])) {
                        $query = htmlspecialchars($_POST['query']);
                        $typeOfQuery = htmlspecialchars($_POST['typeOfQuery']);

                        if($typeOfQuery == "" || ($typeOfQuery != "first_name" && $typeOfQuery != "last_name" && $typeOfQuery != "missionary_title" && $typeOfQuery != "unit_name")) {
                            $typeOfQuery = "first_name";
                        }

                        foreach ($db->query("SELECT
                            up.first_name || ' ' || up.last_name AS full_name,
                            ms.missionary_title AS missionary_name,
                            ms.mission_local,
                            mt.companion_name AS companion,
                            un.unit_name AS ward_or_branch,
                            un.stake_name AS stake,
                            mt.transfer_start,
                            mt.transfer_end
                        FROM
                            user_profile up
                        INNER JOIN missionary_timeline mt ON up.user_id = mt.user_id
                        INNER JOIN unit un ON un.unit_id = mt.unit_id
                        INNER JOIN missionary_service ms ON up.user_id = ms.user_id
                        WHERE $typeOfQuery LIKE '%$query%'") as $row) {
                            echo '<div class="missionary-information-div">';
                            echo '<h3>' . $row['ward_or_branch'] . '</h3>';
                            echo '<h4>' . $row['mission_local'] . '</h4>';

                            echo '<p><span>Fullname:</span> ' . $row['full_name'] . '</p>';
                            echo '<p><span>Missionary Name:</span> ' . $row['missionary_name'] . '</p>';
                            echo '<p><span>Companion:</span> ' . $row['companion'] .  '<p>';
                            echo '<p><span>Period:</span> from ' . $row['transfer_start'] . ' to ' . $row['transfer_end']  . '<p>';


                            echo '</div>';
                        }

                    } 
                ?>
            </div>
            
            <p><em>DISCLAIMER: We work with the concept of crowdsourcing, thus the information available here is NOT provided by the Church. Any information was provided by another user like yourself. You're also welcomed to colaborate.</em></p>

            <p><em><a href="add-info.php">Click here</a> to add your own missionary information.</em></p>


        </section>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?> 
    </footer>

    <!-- Importing FontAwesome icons -->
    <script src="https://kit.fontawesome.com/d92ab94eeb.js"></script>

</body>
</html>