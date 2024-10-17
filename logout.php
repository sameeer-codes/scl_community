<?php require 'templates/header.php' ?>
<?php
$_SESSION = [];
session_destroy();
?>

<div class="container mainBody">You have Been Successfully Logged Out</div>
<script>

setTimeout(() => {
    window.location = '/login_system'
}, 3000);
</script>


<?php require 'templates/footer.php' ?>