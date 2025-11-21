<?php
// include the database connection
include 'db.php';
// get the student id from the URL
$id = $_GET['id'];
// if the update form was submitted
if (isset($_POST['update']))
{
    // get new values
    $name = $_POST['name'];
    $email = $_POST['email'];

    // build the SQL update query
    $sql = "UPDATE students SET name='$name', email='$email' WHERE id=$id";

    // run the update query
    mysqli_query($conn, $sql);

    // after updating go back to main page
    header("Location: index.php");
    exit;
}

// if the form is not submitted yet, we nede to load the current student data
$sql = "SELECT * FROM students WHERE id=$id";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result); //gets the row as an associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit student</title>
</head>
<body>
    <h1>Edit student</h1>

    <!-- the form kis prefilled with the current data from the db -->
     <form method="POST" action="">
        <label >Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
        <br><br>

        <label >Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
        <br><br>
        <!-- When this is clicked PHP sees $_POST['update'] -->
         <button type="submit" name="update">Save Changes</button>
     </form>

     <p><a href="index.php">Back to list</a></p>
</body>
</html>