<?php
// index.php
// include the database connection file so we can use $conn
include 'db.php';

// if the form was submitted with the "add" button
if (isset($_POST['add']))
{
    // get vaulues from form
    $name = $_POST['name'];
    $email = $_POST['email'];

    //build a simple SQL INSERT query 
    $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
    //run query
    mysqli_query($conn, $sql);
}

// Get all students from the database to displyay in the table
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>
<body>
    <h1>Student List - Crud</h1>

    <!-- form to add new student-->
    <h2>Add student</h2>
    <form method="POST" action="index.php">
        <label>Name:</label>
        <input type="text" name="name" required>
        <br><br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <button type="submit" name="add">Add student</button>
    </form>

    <hr>

    <!-- Table showing all students pulled from db -->
    <h2>All students</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th> 
        </tr>

        <?php
        // loop through all rows returned
        while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <!-- show student id -->
            <td><?php echo $row['id']; ?></td>

            <!-- use htmlspecialchars to avoid html issues -->
             <td><?php echo htmlspecialchars($row['name']); ?></td>
             <td><?php echo htmlspecialchars($row['email']); ?></td>

             <!-- links pass the student id in the URL e.g. edit.php?id=3 -->
              <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
              </td>            
        </tr>
        
        <?php } ?>
    
    </table>
</body>
</html>