<?php
session_start();
include '../db.php';

$message = "";

if (isset($_POST['register']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === "" || $password === "")
    {
        $message = "Please enter a username and password.";
    } 
    else
    {
        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO users (username, password)
                VALUES ('$username', '$hashedPassword')";

        if (mysqli_query($conn, $sql))
        {
            //Then go to login page with message
            header("Location: ../login/index.php?registered=1");
            exit;
        }
        else
        {
            $message = "ERROR: could not register. Username taken.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php if ($message !== "") { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <form method='post' action='index.php'>
        <p>
            <label>Username: </label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label>Password</label>
            <input type="password" name="password" required>
        </p>

        <p>
            <button type="submit" name='register'>Register</button>
        </p>

    </form>

        <p>
            Already have an account? <a href="../login">Login Here.</a>
        </p>
</body>
</html>