<?php 
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $conn = new mysqli('localhost', 'root', '', 'mydatabase');

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Safely retrieve the posted data
        $firstname = $_POST['firstname'] ?? '';
        $lastname  = $_POST['lastname'] ?? '';
        $email     = $_POST['email'] ?? '';

        $sql = "INSERT INTO student (firstname,lastname,email) 
                VALUES ('$firstname', '$lastname', '$email')";


        if ($conn->query($sql) === true) {
            echo 'data inserted successfully';
        } else {
            echo 'data not inserted successfully';
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
            <div class="col-sm-2">

            </div>

            <div class="col-sm-4 p-5 mt-4 border border-primary">

                <h2 class="pb-3"> Registation From </h2>
                <form action="insert.php" method="POST">

                    <h3>First Name</h3>
                    <input type="text" name="firstname" placeholder="Enter your first name">

                    <h3>Last Name</h3>
                    <input type="text" name="lastname" placeholder="Enter your last name">

                    <h3>Email</h3>
                    <input type="email" name="email" placeholder="Enter your email"> <br/> <br/>

                    <input type="submit" value="Submit" name="submit" class="btn btn-success">

                </form>
            </div>

            <div class="col-sm-2">
                
            </div>
        </div>
    </div>

    </body>
</html>



