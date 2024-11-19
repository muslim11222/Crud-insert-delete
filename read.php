<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$conn = new mysqli($hostname, $username, $password, 'mydatabase');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if (isset($_REQUEST['deleteid'])) {
    $recive = $_REQUEST['deleteid'];

    if (filter_var($recive, FILTER_VALIDATE_INT)) {
        $stmt = $conn->prepare("DELETE FROM student WHERE id = ?");
        $stmt->bind_param("i", $recive);

        if ($stmt->execute()) {
            header('Location: read.php?deleted');
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Invalid ID.";
    }
}
?>

<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 p-5 mt-4 border border-primary">
            <h1 class="pb-4 text-center btn-success text-white">User Information</h1>
            <?php
            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<table class="table table-success">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>';
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];

                    echo "<tr>
                            <td>$id</td>
                            <td>$firstname</td>
                            <td>$lastname</td>
                            <td>$email</td>
                            <td>
                                <span class='btn btn-success'>
                                    <a href='edit.php?id=$id' class='text-white'>Edit</a>
                                </span>
                                <span class='btn btn-danger'>
                                    <a href='read.php?deleteid=$id' class='text-white'>Delete</a>
                                </span>
                            </td>
                          </tr>";
                }
                echo '</table>';
            }
            ?>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
</body>
</html>
