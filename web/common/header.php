<section>
    <nav id="top-header">
        <div class="content-width"> <!-- This DIV has only style purposes --> 

            <?php
                if (isset($_SESSION['username'])) {

                    $username = $_SESSION['username'];

            ?>

            <ul>
                <li>Welcome <em><?= $username ?></em>  |  <a href="logout.php">Sign Out <i class="fas fa-sign-out-alt"></i></a> </li>
            </ul> 
            
            <?php
                } else {
            ?>

            <ul>
                <li><a href="login.php">Register/Login <i class="fas fa-user"></i></a></li>
            </ul> 

            <?php
                } 
            ?>

        </div>
    </nav>
    <nav id="main-navigation">
        <div class="content-width" id="logo-ul-holder"> <!-- This DIV has only style purposes -->
            <p id="logo"><a href="index.php"><span>me</span>SSION</a></p>

            <ul>

                <?php
                    if (isset($_SESSION['username'])) {
                ?>                
                
                <li><a href="add-info.php">Add Info <i class="fas fa-address-book"></i></a></li>

                <li><a href="index.php">Search <i class="fas fa-search"></i> </a></li>
    
                <?php
                    } 
                ?>


                
            </ul>
        </div>
    </nav>
</section>

    