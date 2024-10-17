<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function cleanInput($input)
    {
        return htmlspecialchars(trim($input));
    }

    $useremail = cleanInput($_POST['useremail']);
    $password = cleanInput($_POST['password']);

    // Use SQL to check if the user exists with the given email or username
    $email_exists = "SELECT * FROM `users` WHERE email = '$useremail' OR username = '$useremail'";
    $result = mysqli_query($connect, $email_exists);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            header('Location: /login_system');
            exit();
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Incorrect Password
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Account Not Found
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }

    mysqli_close($connect);
}
?>
<div class="loginForm w-50 container mt-4 pt-4">
    <h2>Login</h2>
    <hr>
    <form class="mt-4" id="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="mb-3">
            <label for="useremail" class="form-label">Email address or Username</label>
            <input type="text" class="form-control" id="useremail" aria-describedby="emailHelp" name="useremail">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <p class="mt-4">Don't have an account? <a href="signup.php">Sign Up</a></p>
        <button type="submit" class="btn btn-primary rounded-0">Submit</button>
    </form>
</div>