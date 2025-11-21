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
    $course = $_POST['course'];
    $progress = $_POST['progress'];
    $notes = $_POST['notes'];

    //build a simple SQL INSERT query 
    $sql = "INSERT INTO students (name, email, course, progress, notes) VALUES ('$name', '$email', '$course', '$progress', '$notes')";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Crud</title>
</head>
<body>
    <h1 class="text alert-info">Student List - Crud</h1>

    <!-- form to add new student-->
    <h2>Add student</h2>
    <form method="POST" action="index.php">
        <div class="form-control">
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <br><br>
        <div class="form-control">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <br><br>
        <div class="form-control">
            <label>Course:</label>
            <input type="text" name="course" required>
        </div>
        <br><br>
        <div class="form-control">
            <label>Progress:</label>
            <input type="text" name="progress" required>
        </div>
        <br><br>
        <div class="form-control">
            <label>Notes:</label>
            <input type="text" name="notes" required>
        </div>
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
            <th>Course</th>
            <th>Progress</th>
            <th>Notes</th>

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
             <td><?php echo htmlspecialchars($row['course']); ?></td>
             <td><?php echo htmlspecialchars($row['progress']); ?></td>
             <td><?php echo htmlspecialchars($row['notes']); ?></td>

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