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
        

        </section>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?> 
    </footer>

    <script src=""></script>    

    <!-- Importing FontAwesome icons -->
    <script src="https://kit.fontawesome.com/d92ab94eeb.js"></script>

</body>
</html>