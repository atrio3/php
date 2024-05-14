<?php
// Server name, username, password, and database name for MySQL connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and escape user inputs
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $active = mysqli_real_escape_string($conn, $_POST["active"]);

    // SQL query to insert data into the users table
    $sql = "INSERT INTO users (id, name, email, password, active) VALUES ('$id', '$name', '$email', '$password', '$active')";

    // Execute the query and check for errors
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Registration Form</title>
</head>

<body>
    <h2>Email Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        ID: <input type="text" name="id" required><br><br>
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Active: <input type="text" name="active" required><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>