<?php require 'header.php' ?>
<div class="mainBody">
    <?php
    if ($loggedin == false) {
        require 'login.php';
    } else {
        echo 'Welcome to your account ' . $_SESSION['username'];
    }
    ?>
</div>
<?php require 'footer.php' ?>