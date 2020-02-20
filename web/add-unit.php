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
    <title>Add Unit Only | meSSION</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?> 
    </header>
    <main>
        <section  class="content-width">

            <section class="add-info-form">

                <h2>Add Missionary Information</h2>

                <p>Please colaborate with us by adding your own missionary information.</p>

                <form action="add-unit.php" method="post" id="add-unit-form">                    

                    <fieldset>

                        <legend>Add Unit (Ward or Branch)</legend>

                        
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

                    </fieldset>

                    <input type="submit" name="submit_unit" class="submit-button">

                </form>
            </section>
        
            <?php
                
                if(!empty($_POST)) { 

                    echo '<p>post is set</p>';                    
                    
                    // Unit Data                    
                    $unitName = htmlspecialchars($_POST['unitName']);
                    echo '<p>' . $unitName . '</p>';
                    $unitNumber = htmlspecialchars($_POST['unitNumber']);
                    echo '<p>' . $unitNumber . '</p>';
                    $stakeName = htmlspecialchars($_POST['stakeName']);
                    echo '<p>' . $stakeName . '</p>';
                    $stakeCity = htmlspecialchars($_POST['stakeCity']);
                    echo '<p>' . $stakeCity . '</p>';
                    $stakeState = htmlspecialchars($_POST['stakeState']);
                    echo '<p>' . $stakeState . '</p>';
                    $stakeCountry = htmlspecialchars($_POST['stakeCountry']);
                    echo '<p>' . $stakeCountry . '</p>';

                    $stmt = $db->prepare("INSERT INTO unit (unit_id, unit_number, unit_name, stake_name, city, state, country) VALUES (NEXTVAL('unit_unit_id_seq'), :unit_number, :unit_name, :stake_name, :city, :state, :country);");
                    $stmt->bindValue(':unit_number', $unitNumber, PDO::PARAM_INT);
                    $stmt->bindValue(':unit_name', $unitName, PDO::PARAM_STR);
                    $stmt->bindValue(':stake_name', $stakeName, PDO::PARAM_STR);
                    $stmt->bindValue(':city', $stakeCity, PDO::PARAM_STR);
                    $stmt->bindValue(':state', $stakeState, PDO::PARAM_STR);
                    $stmt->bindValue(':country', $stakeCountry, PDO::PARAM_STR);
                    $stmt->execute();

                    echo '<p>Insert unit done</p>';

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