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
    $repassword = $_POST["re-password"];
    
    if($password != $repassword)
    {
        echo "<script type='text/javascript'>alert('Passwords do not match.')</script>";
        include('signup.html');
    }
    
    else
    {
        $query = "INSERT INTO Accounts (username, password) VALUES ('$username', '$password')";
 
        if ($conn->query($query) === TRUE)
        {
            echo "<script type='text/javascript'>alert('Account created successfully')</script>";
            include('index.html');
        }
        else
            echo "Error: " . $query . "<br>" . $conn->error;
    }
    $conn->close();
?>
