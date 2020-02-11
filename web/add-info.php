<?php 
// Start the session
session_start();
    require "connection/connect.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Information | meSSION</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?> 
    </header>
    <main>
        <section  class="content-width">

            <a href="add-unit-only.php" id="add-unit-button">Add Unit Only</a>

            <section class="add-info-form">

                <h2>Add Missionary Information</h2>

                <p>Please colaborate with us by adding your own missionary information.</p>

                <form action="login.php" method="POST" id="register-form">

                    <fieldset>

                        <legend>Information about your mission</legend>

                        <label for="missionLocal">Mission Name: </label>
                        <input type="text" name="missionLocal" id="missionLocal" placeholder="Where did you serve your mission?">

                        <label for="missionaryTitle">Missionary Name: </label>
                        <input type="text" name="missionaryTitle" id="missionaryTitle" placeholder="What was your missionary name?">

                        <label for="missionStart">Mission Start Date: </label>
                        <input type="date" name="missionStart" id="missionStart">

                        <label for="missionEnd">Mission End Date: </label>
                        <input type="date" name="missionEnd" id="missionEnd">                        

                    </fieldset>

                    <fieldset>

                        <legend>Information about one of your transfers (period of about 6 weeks).</legend>

                        <label for="companionName">Companion Name: </label>
                        <input type="text" name="companionName" id="companionName" placeholder="Who was your companion during this transfer?">
                        
                        <label for="unitName">Unit Name: </label>
                        <input type="text" name="unitName" id="unitName" placeholder="What was the name of the ward or branch?">

                        <label for="unitNumber">Unit Number (official Church number): </label>
                        <input type="text" name="unitNumber" id="unitNumber" placeholder="Do you happen to know the unit's official number?">
                        <p class="form-help-paragraph"> *Leave it blank if you don't know it.</p>

                        <label for="stakeName">Stake Name: </label>
                        <input type="text" name="stakeName" id="stakeName" placeholder="What was the name of the stake?">

                        <label for="stakeCity">Stake City: </label>
                        <input type="text" name="stakeCity" id="stakeCity" placeholder="What city did the unit/stake belong to?">

                        <label for="stakeState">Stake State: </label>
                        <input type="text" name="stakeState" id="stakeState" placeholder="What state did the unit/stake belong to?">

                        <label for="stakeCountry">Stake Country: </label>
                        <input type="text" name="stakeCountry" id="stakeCountry" placeholder="What country did the unit/stake belong to?">

                        <label for="transferStart">Transfer Start Date: </label>
                        <input type="date" name="transferStart" id="transferStart">

                        <label for="transferEnd">Transfer End Date: </label>
                        <input type="date" name="transferEnd" id="transferEnd">                        

                    </fieldset>

                    <button type="submit" class="btn" name="reg_user">Add Info</button>

                </form>
            </section>
        
            <?php
                if (isset($_POST)) {                

                    // echo '<p>post is set!</p>';

                    //  Missionary Data
                    $missionLocal = htmlspecialchars($_POST[missionLocal]);
                    // echo '<p>Book: ' . $book . '</p>';
                    $missionaryTitle = htmlspecialchars($_POST[missionaryTitle]);
                    //echo '<p>Chapter: ' . $chapter . '</p>';
                    $missionStart = htmlspecialchars($_POST[missionStart]);
                    //echo '<p>Verse: ' . $verse . '</p>';
                    $missionEnd = htmlspecialchars($_POST[missionEnd]);
                    //echo '<p>Content: ' . $content . '</p>';   
                    
                    // Unit Data
                    $companionName = htmlspecialchars($_POST[companionName]);
                    $unitName = htmlspecialchars($_POST[unitName]);
                    $unitNumber = htmlspecialchars($_POST[unitNumber]);
                    $stakeName = htmlspecialchars($_POST[stakeName]);
                    $stakeCity = htmlspecialchars($_POST[stakeCity]);
                    $stakeState = htmlspecialchars($_POST[stakeState]);
                    $stakeCountry = htmlspecialchars($_POST[stakeCountry]);
                    $transferStart = htmlspecialchars($_POST[transferStart]);
                    $transferEnd = htmlspecialchars($_POST[transferEnd]);

                    //echo '<pre>'; print_r($_POST['topics']); echo '</pre>';                    
                    
                    $stmt = $db->prepare("INSERT INTO public.missionary_service (missionary_title, mission_local, mission_start, mission_end) VALUES (:missionary_title, :mission_local, :mission_start, :mission_end);");
                    $stmt->bindValue(':missionary_title', $missionaryTitle, PDO::PARAM_STR);
                    $stmt->bindValue(':mission_local', $missionLocal, PDO::PARAM_STR);
                    $stmt->bindValue(':mission_start', $missionStart, PDO::PARAM_STR);
                    $stmt->bindValue(':mission_end', $missionEnd, PDO::PARAM_STR);
                    
                    $stmt->execute();

                    $stmt = $db->prepare("INSERT INTO public.unit (unit_number, unit_name, stake_name, city, state, country) VALUES (:unit_number, :unit_name, :stake_name, :city, :state, :country);");
                    $stmt->bindValue(':unit_number', $unitNumber, PDO::PARAM_INT);
                    $stmt->bindValue(':unit_name', $unitName, PDO::PARAM_STR);
                    $stmt->bindValue(':stake_name', $stakeName, PDO::PARAM_STR);
                    $stmt->bindValue(':city', $stakeCity, PDO::PARAM_STR);
                    $stmt->bindValue(':state', $stakeState, PDO::PARAM_STR);
                    $stmt->bindValue(':country', $stakeCountry, PDO::PARAM_STR);
                    
                    $stmt->execute();


                    $userId = $db->lastInsertId("users_user_id_seq");
                    $unitId = $db->lastInsertId("unit_unit_id_seq"); 

                    $stmt = $db->prepare("INSERT INTO public.missionary_timeline (user_id, unit_id, companion_name, transfer_start, transfer_end) VALUES (:user_id, :unit_id, :companion_name, :transfer_start, :transfer_end);");
                    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
                    $stmt->bindValue(':unit_id', $unitId, PDO::PARAM_INT);
                    $stmt->bindValue(':companion_name', $companionName, PDO::PARAM_STR);
                    $stmt->bindValue(':transfer_start', $transferStart, PDO::PARAM_STR);
                    $stmt->bindValue(':transfer_end', $transferEnd, PDO::PARAM_STR);
                    
                    $stmt->execute();

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