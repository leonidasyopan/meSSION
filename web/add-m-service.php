<?php 
// Start the session
session_start();
    require "connection/connect.php";

if (isset($_SESSION['username']))
{
    $username = $_SESSION['username'];
}
else
{
    header("Location: index.php");
    die(); // we always include a die after redirects.
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Missionary Service | meSSION</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?> 
    </header>
    <main>
        <section  class="content-width">

            <section class="add-info-form">

                <h2>Add Missionary Service</h2>

                <p></p>

                <form action="add-m-service.php" method="post" id="add-m-service-form">                    

                    <fieldset>

                        <legend>Information about your mission</legend>

                        <label for="missionLocal">Mission Name: </label>
                        <input type="text" name="missionLocal" id="missionLocal" placeholder="Where did you serve your mission?">

                        <label for="missionaryTitle">Missionary Name: </label>
                        <input type="text" name="missionaryTitle" id="missionaryTitle" placeholder="example: Elder Smith">

                        <label for="missionStart">Mission Start Date: </label>
                        <input type="date" name="missionStart" id="missionStart">

                        <label for="missionEnd">Mission End Date: </label>
                        <input type="date" name="missionEnd" id="missionEnd">                

                    </fieldset>

                    <input type="submit" name="submit_unit" class="submit-button">

                </form>
            </section>
        
            <?php
                
                if(!empty($_POST)) {               
                    
                    //  Missionary Data
                    $missionLocal = htmlspecialchars($_POST['missionLocal']);
                    $missionaryTitle = htmlspecialchars($_POST['missionaryTitle']);
                    $missionStart = htmlspecialchars($_POST['missionStart']);
                    $missionEnd = htmlspecialchars($_POST['missionEnd']);

                    $stmt = $db->prepare("INSERT INTO missionary_service (user_id, missionary_title, mission_local, mission_start, mission_end) VALUES (CURRVAL('user_access_user_id_seq'), :missionary_title, :mission_local, :mission_start, :mission_end);");
                    $stmt->bindValue(':missionary_title', $missionaryTitle, PDO::PARAM_STR);
                    $stmt->bindValue(':mission_local', $missionLocal, PDO::PARAM_STR);
                    $stmt->bindValue(':mission_start', $missionStart, PDO::PARAM_STR);
                    $stmt->bindValue(':mission_end', $missionEnd, PDO::PARAM_STR);
                    $stmt->execute();

                    echo '<p>Insert missionary service done</p>';

                }
            ?>

        </section>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?> 
    </footer>
    
    <!-- Importing FontAwesome icons -->
    <script src="https://kit.fontawesome.com/d92ab94eeb.js"></script>

</body>
</html>