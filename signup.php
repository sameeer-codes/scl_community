<?php require 'header.php'; ?>

<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Initialize variables (no need to initialize with a space)
    $email = $username = $password = $name = '';

    // Function to clean user input
    function cleanInput($input)
    {
        // Sanitize input and return the cleaned value
        $input = trim($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Retrieve and clean input data
    $email = cleanInput($_POST['email']);
    $username = cleanInput($_POST['username']);
    $name = cleanInput($_POST['name']);
    $password = password_hash(cleanInput($_POST['password']), PASSWORD_ARGON2ID);

    // Check if the account already exists
    $email_exits = "SELECT * FROM `users` WHERE email = '$email'";
    $username_exits = "SELECT * FROM `users` WHERE username = '$username'";

    // Check if email already exists
    $email_result = mysqli_query($connect, $email_exits);
    if ($email_result && mysqli_num_rows($email_result) > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Account Already Exists
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    // Check if username already exists
    else {
        $username_result = mysqli_query($connect, $username_exits);
        if ($username_result && mysqli_num_rows($username_result) > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Username already taken.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        // Insert new user if email and username are unique
        else {
            // Prepare SQL query
            $sql = "INSERT INTO `users` (`email`, `username`, `name` ,`password_hash`) VALUES ('$email', '$username', '$name' ,'$password')";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Account has been created successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;

                header('location: /login_system');

            } else {
                // Use mysqli_error($connect) for the error message
                echo "Error creating account: " . mysqli_error($connect);
            }
        }
    }
}

mysqli_close($connect);
?>

<div class="SignupForm w-50 container mt-4">
    <h2>Sign Up</h2>
    <hr>
    <form class="mt-4" id="SignupForm" action="signup.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3 passwordContainer">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password"
                aria-describedby="passwordHelpBlock">
            <span id="passwordEye"><i class="bi bi-eye-slash"></i></span>

            <div id="passwordHelpBlock" class="form-text">
                Your password must contain at least one lowercase letter, one uppercase letter, and one number.
            </div>
        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
        </div>
        <p class="mt-4">Already have an account? <a href="login.php">Login</a></p>
        <button type="submit" class="btn px-4 w-100 mt-2 btn-primary rounded-0">Submit</button>
    </form>
</div>
<?php require 'footer.php' ?>