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
    <title>Add Missionary Timeline | meSSION</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?> 
    </header>
    <main>
        <section  class="content-width">

            <section class="add-info-form">

                <h2>Add Missionary Timeline</h2>

                <p></p>

                <form action="add-m-timeline.php" method="post" id="add-m-timeline-form">                    

                    <fieldset>

                        <legend>Add Transfer Information</legend>

                        
                        <label for="unitName">Unit Name: </label>
                        <input type="text" name="unitName" id="unitName" placeholder="What was the name of the ward or branch?">

                        <label for="companionName">Companion Name: </label>
                        <input type="text" name="companionName" id="companionName" placeholder="Who was your companion during this transfer?">

                        <label for="transferStart">Transfer Started: </label>
                        <input type="date" name="transferStart" id="transferStart">

                        <label for="transferEnd">Transfer Ended: </label>
                        <input type="date" name="transferEnd" id="transferEnd">                      

                    </fieldset>

                    <input type="submit" name="submit_unit" class="submit-button">

                </form>
            </section>
        
            <?php
                
                if(!empty($_POST)) { 

                    echo '<p>post is set</p>';                    
                    
                    // Timeline Data
                    // $unitName = htmlspecialchars($_POST['unitName']);
                    // echo '<p>' . $unitName . '</p>';
                    $companionName = htmlspecialchars($_POST['companionName']);
                    echo '<p>' . $companionName . '</p>';                    
                    $transferStart = htmlspecialchars($_POST['transferStart']);
                    echo '<p>' . $transferStart . '</p>';
                    $transferEnd = htmlspecialchars($_POST['transferEnd']);
                    echo '<p>' . $transferEnd . '</p>';

                    $stmt = $db->prepare("INSERT INTO missionary_timeline (user_id, unit_id, companion_name, transfer_start, transfer_end) VALUES (CURRVAL('user_access_user_id_seq'), CURRVAL('unit_unit_id_seq'), :companion_name, :transfer_start, :transfer_end);");
                    $stmt->bindValue(':companion_name', $companionName, PDO::PARAM_STR);
                    $stmt->bindValue(':transfer_start', $transferStart, PDO::PARAM_STR);
                    $stmt->bindValue(':transfer_end', $transferEnd, PDO::PARAM_STR);
                    $stmt->execute();

                    echo '<p>Insert missionary timeline done</p>';

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