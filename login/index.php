<?php
session_start();
include '../db.php';

$error = '';

// check if user has just registered
$registered = isset($_GET['registered']);

if (isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    //lookup username
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1)
    {
        $user = mysqli_fetch_assoc($result);

        // check hash
        if (passworD_verify($password, $user['password']))
        {
            // success
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];

            header("Location: ../index.php");
            exit;
        }
        else
        {
            $error = "Incorrect password";
        }
    }
    else
    {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if ($registered) { ?>
        <p>Registration successful. Please log in</p>
    <?php } ?>
    
    <?php if ($error !== "") { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form method='post' action="index.php">
        <p>
            <label for="">Username:</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="">password:</label>
            <input type="password" name="password" required>
        </p>

        <p>
            <button type="submit" name="login">Login</button>
        </p>
    </form>

    <p>
        No account yet? <a href="../register">Register here.</a>
    </p>

</body>
</html>