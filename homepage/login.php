<?php
    DEFINE('DB_USERNAME', 'root');
    DEFINE('DB_PASSWORD', 'root');
    DEFINE('DB_SERVER', 'localhost');
    DEFINE('DB_DATABASE', 'VisualWorks');
    
    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    
    // Check connection
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT * FROM accounts WHERE username = '$username' and password='$password';";

    if ($result=mysqli_query($conn,$query))
    {
        if(mysqli_num_rows($result) > 0)
        {
            echo "<script type='text/javascript'>alert('Logged in successfully.')</script>";
            include('index.html');
        }
        else
        {
            echo "<script type='text/javascript'>alert('Invalid username or password.')</script>";
            include('login.html');
        }
    }
    else
        echo "<script type='text/javascript'>alert('Query Failed.')</script>";
 
    $conn->close();
?>
